const toggleBtn = document.getElementById("toggleSidebar");
const sidebar = document.getElementById("sidebar");
const navbar = document.getElementById("navbar");

toggleBtn.addEventListener("click", function () {
  sidebar.classList.toggle("hidden");
  navbar.classList.toggle("full");
});
