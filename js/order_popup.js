function openPopup(productName) {
    document.getElementById("popup").style.display = "flex";
    document.getElementById("pname").innerText = productName;
}

function closePopup() {
    document.getElementById("popup").style.display = "none";
}

function submitOrder() {
    alert("🎉 Thank you for ordering! Visit again ❤️");
    closePopup();
}