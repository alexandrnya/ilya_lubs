// возвращает куки с указанным name,
// или undefined, если ничего не найдено
function getCookie(name) {
    let matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}

function setCookie(name, value, options = {}) {

    options = {
        path: '/',
        expires: {
        },
        // при необходимости добавьте другие значения по умолчанию
        ...options
    };

    if (options.expires.toUTCString) {
        options.expires = options.expires.toUTCString();
    }

    let updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value);

    for (let optionKey in options) {
        updatedCookie += "; " + optionKey;
        let optionValue = options[optionKey];
        if (optionValue !== true) {
            updatedCookie += "=" + optionValue;
        }
    }

    document.cookie = updatedCookie;
}

function deleteCookie(name) {
    setCookie(name, "", {
        'max-age': -1
    })
}

function createPopup() {
    var popup = document.querySelector("#popup");
    if(!popup) {
        var popupCreate = document.createElement("div");
        popupCreate.className = "popup";
        popupCreate.id = "popup";
        popupCreate.innerHTML = "<div class='popup-content'>\n" +
            "            <span class='closebtn' onclick='closePopup()'>&times;</span>\n" +
            "            Введите имя\n" +
            "            <input type='text' name='name' placeholder='Илюша'>\n" +
            "            <button onclick='saveName()'>Сохранить</button>\n" +
            "        </div>";
        document.body.append(popupCreate);
    } else {
        openPopup();
    }
}

function saveName() {
    var input = document.querySelector("#popup input[name=name]");
    var inputValue = input.value;
    //if (inputValue.length > 0)
    {
        setCookie("name", inputValue);
        closePopup();
        getSalute();
    }
}

function closePopup() {
    document.querySelector("#popup").style.display='none';
}

function openPopup() {
    document.querySelector("#popup").style.display='block';
}

function getSalute() {
    var name = getCookie("name");
    var salute = document.querySelector("div#salute");
    if(name.length > 0) {
        salute.innerHTML = "<strong>Привет, " + name + "</strong>";
    } else {
        salute.innerHTML = "<strong>Привет</strong>";
    }
}

function changeTheme() {
    const theme = document.querySelector("link#theme");
    var themeCookie = getCookie("theme"),
        themeName1 = 'styles/themes/red.css',
        themeName2 = `styles/themes/dark_orange.css`;

    if(themeCookie === themeName1 || !themeCookie) {
        theme.setAttribute("href", themeName2);
        setCookie("theme", themeName2)
    } else {
        theme.setAttribute("href", themeName1);
        setCookie("theme", themeName1)

    }
}

function getAlert() {
    var name = getCookie("name");
    var mess = "";
    if(name.length > 0) {
        mess = name + ", вы покидаете текущий сайт и попадаете на сайт google.com";
    }
    else {
        mess = "Вы покидаете текущий сайт и попадаете на сайт google.com";
    }
    alert(mess);
}

function selectedActiveMenu() {
    var location = window.location.href;
    as = document.querySelectorAll("a");
    for(let key in as) {
        if(as[key].href === location) {
            as[key].classList.add("selected");
        }
    }

}

function getName() {
    var name = getCookie("name");
    if(name) {
        getSalute();
    }
    else {
        openPopup();
    }
}

function addEventClickExtra() {
    var extraBlocks = document.querySelectorAll(".extra_info");
    for (var key = 0, len = extraBlocks.length; key < len; key++) {
        extraBlocks[key].querySelector(".extra_title").addEventListener("click", function (e) {
            this.parentNode.querySelector(".extra_body").classList.toggle("hide");
        });
    }
}

window.onload = function () {
    selectedActiveMenu();
    getName();
    addEventClickExtra();
};