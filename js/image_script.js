function show_image(id, img_name) {
  // console.log(id + ", " + img_name);

  // Get the modal
  var modal = document.getElementById("imgModal");

  // Get the image and insert it inside the modal - use its "alt" text as a caption
  var img = document.getElementById(id);
  var modalImg = document.getElementById("img_content");
  var captionText = document.getElementById("caption");
  // img.onclick = function(){
    console.log(this.alt);
    modal.style.display = "block";
    modalImg.src = img_name;
    captionText.innerHTML = img.alt;
  // }
  // Get the <span> element that closes the modal
  // var span = document.getElementsByClassName("close")[0];

  // When the user clicks on <span> (x), close the modal
  // span.onclick = function() {

  modal.onclick = function() {
    modal.style.display = "none";
  }

}
