function modalOpen(event) {
  // すべてのモーダルを一旦非表示にする
  document.querySelectorAll('.modal-close').forEach(modal => {
    modal.style.display = 'none';
  });

  // クリックされた要素からdata-modal属性を取得
  const modalImg = event.currentTarget;
  const dataModalImg = modalImg.getAttribute("data-modal");
  const dataModalTarget = document.getElementById(dataModalImg);

  if (dataModalTarget) {
    dataModalTarget.style.display = "block";
  }
}

function bannerOpen() {
  const closeBanner = document.querySelector(".banner-close-block");
  const openBanner = document.querySelector(".banner-open-block");

  // banner-close-blockを右へスライドして非表示
  closeBanner.classList.add("closed");

  // banner-open-blockを右からスライドインで表示
  setTimeout(() => {
    openBanner.classList.add("open");
  }, 500); // closeBannerのアニメーション後
}

function bannerClose() {
  const closeBanner = document.querySelector(".banner-close-block");
  const openBanner = document.querySelector(".banner-open-block");

  // banner-open-blockを右へスライドして非表示
  openBanner.classList.remove("open");

  // banner-close-blockを右からスライドインで表示
  setTimeout(() => {
    closeBanner.classList.remove("closed");
  }, 500); // openBannerのアニメーション後
}

fetch('../mycart.php')
  .then(response => response.json())
  .then(data => {
    console.log(data); // PHPから取得したデータ
  });
