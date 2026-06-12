const navItems = document.querySelectorAll(".navigation li");

function setHoveredItem() {
  navItems.forEach((item) => item.classList.remove("hovered"));
  this.classList.add("hovered");
}

navItems.forEach((item) => item.addEventListener("mouseover", setHoveredItem));

const toggle = document.querySelector(".toggle");
const navigation = document.querySelector(".navigation");
const main = document.querySelector(".main");

if (toggle && navigation && main) {
  toggle.addEventListener("click", () => {
    navigation.classList.toggle("active");
    main.classList.toggle("active");
  });
}
