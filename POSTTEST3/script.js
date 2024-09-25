alert("Mohon maaf ya bang masih belum sempurna:((( pas di upload di github gatau kenapa gambarnya gamuncul")


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