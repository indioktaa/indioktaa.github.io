alert("Mohon maaf ya bang masih belum sempurna:(((")


const hamburger = document.querySelector(".hamburger")
let navbar = document.querySelector('.header .flex .navbar');

hamburger.addEventListener("click", () => {
    hamburger.classList.toggle("active");
    navbar.classList.toggle("active");
});

document.querySelectorAll(".navbar").forEach(n => n.addEventListener("click", () =>{
    hamburger
})
);