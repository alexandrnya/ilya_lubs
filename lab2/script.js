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

window.onload = function () {
    var location = window.location.href;
    as = document.querySelectorAll("a");
    for(let key in as) {
        if(as[key].href === location) {
            as[key].classList.add("selected");
        }
    }
};