const tests = document.querySelectorAll(".test");
const productListBoNones = document.querySelectorAll(".product-list-box-none");

tests.forEach((test) => {
  test.addEventListener("click", function () {
    const dataImg = this.getAttribute("data-img");


    const dataTarget = document.getElementById(dataImg);
    if (dataTarget) {
      dataTarget.style.display = "block";
    }


    productListBoNones.forEach((productListBoNone) => {
  
      if (productListBoNone.id !== dataImg) {
        productListBoNone.style.display = "none";
      }
    });
  });
});
