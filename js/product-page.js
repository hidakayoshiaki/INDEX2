function modalOpen(event) {

  const clickedElement = event.currentTarget;
  const imageUrl = clickedElement.getAttribute("data-image-url");
  const imageAlt = clickedElement.getAttribute("data-image-alt");

  // モーダル用の要素を取得
  const modalContainer = document.getElementById("modal-container");
  const modalImage = document.getElementById("modal-image");

  if (modalContainer && modalImage && imageUrl) {

    modalImage.src = imageUrl;
    modalImage.alt = imageAlt;

    modalContainer.style.display = "flex";
  }
}
