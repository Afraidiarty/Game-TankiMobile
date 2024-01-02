// Находим элемент с классом "btn2"
var btn2 = document.querySelector(".btn2");
var auth = document.getElementById("auth");
var germ = document.getElementById("germ");
var ussr = document.getElementById("ussr");
var usa = document.getElementById("usa");

// Добавляем обработчик события "click" на эту кнопку
btn2.addEventListener("click", function(event) {
    // Отменяем стандартное действие ссылки (переход по ссылке)
    event.preventDefault();

    // Скрываем кнопку
    btn2.style.display = "none";
    auth.style.display = "block";
});



