
<!DOCTYPE html>
<html>
<head>
<title>Title of the document</title>
<style>
.loader {
    position: fixed;
    z-index: 99;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: white;
    display: flexa;
    justify-content: center;
    align-items: center;
}

.loader > img {
    width: 100px;
}

.loader.hidden {
    animation: fadeOut 1s;
    animation-fill-mode: forwards;
}

@keyframes fadeOut {
    100% {
        opacity: 0;
        visibility: hidden;
    }
}

.thumb {
    height: 100px;
    border: 1px solid black;
    margin: 10px;
}
#loader {
  margin: 100px auto;
  width: 120px;
  height: 120px;
  border: 16px solid #f3f3f3;
  border-top: 16px solid #3498db;
  border-radius: 50%;
  animation: spin 2s linear infinite, heart-beat 2s linear infinite;
  background-color: #fff;
  text-align: center;
  line-height: 120px;
}


@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

@keyframes heart-beat {
    55% { background-color: #fff; }
    60% { background-color: #3498db; }
    65% { background-color: #fff; }
    70% { background-color: #3498db; }
    100% { background-color: #fff; }
}

</style>
<script>
window.addEventListener("load", function () {
    const loader = document.querySelector(".loader");
    loader.className += " hidden"; // class "loader hidden"
});
</script>

  
</head>


<body>
<div class="loader">
<div id="loader"></div>
</div>


</body>

</html>