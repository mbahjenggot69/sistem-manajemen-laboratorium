// Get a reference to the scroll-to-top button
const scrollToTopButton = document.getElementById("scroll-to-top-button");

// Add a click event listener to scroll to the top of the page
scrollToTopButton.addEventListener("click", function () {
    window.scrollTo({
        top: 0,
        behavior: "smooth" // You can use "auto" for instant scrolling
    });
});

// Hide or show the button based on the user's scroll position
window.addEventListener("scroll", function () {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        scrollToTopButton.style.display = "block";
    } else {
        scrollToTopButton.style.display = "none";
    }
});