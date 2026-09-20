document.addEventListener("DOMContentLoaded", function () {

    let items = document.querySelectorAll(".coverflow-item");
    let current = 0;

    if (items.length === 0) {
        console.log("No coverflow items found");
        return;
    }

    function update() {
        items.forEach((item, index) => {
            item.classList.remove("active");

            if (index === current) {
                item.classList.add("active");
            }
        });
    }

    function next() {
        current = (current + 1) % items.length;
        update();
    }

    function prev() {
        current = (current - 1 + items.length) % items.length;
        update();
    }

    update();

    setInterval(next, 2500);

});