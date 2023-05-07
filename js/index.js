function getfile(){
    document.getElementById('hiddenfile').click();
}

// La fonction previewPicture
function previewPicture(e){
    countImg = document.getElementsByClassName('post-input-images').length;
    if(countImg >= 4){
        return;
    }
    var divImages = document.getElementById("new-post-images");
    var cmpImg = countImg;
        Array.from(e.files).forEach(element => {

            if (element && cmpImg < 4) {
                var oImg = document.createElement("img");
                oImg.setAttribute('src', URL.createObjectURL(element));
                oImg.setAttribute('accept', 'image/jpeg, image/jpg, image/png');
                oImg.setAttribute('alt', 'na');
                oImg.setAttribute('width', '500px');
                oImg.setAttribute('class', 'post-input-images');
                var base = document.createElement("input");
                base.type = "hidden";
                base.name = "base"+ cmpImg;
                var type = document.createElement("input");
                type.type = "hidden";
                type.name = "type"+ cmpImg;
	    
                // Créer un bouton de suppression pour cette image
                var deleteBtn = document.createElement("button");
                //deleteBtn.setAttribute('width', '500px');
                deleteBtn.innerHTML = "X";
                deleteBtn.addEventListener("click", function() {
                    divImages.removeChild(oImg);
                    divImages.removeChild(deleteBtn);
                });
                
                fetch(oImg.src) .then((res) => res.blob()) .then((blob) => {
                    // Read the Blob as DataURL using the FileReader API
                    const reader = new FileReader();
                    reader.onloadend = () => {
                        oImg.src = reader.result;
                        base.value = (reader.result).split("base64,")[1];
                        type.value =(reader.result).split(";")[0].split("data:")[1];
                    };
                    reader.readAsDataURL(blob);
                });
                divImages.appendChild(oImg);
                divImages.appendChild(deleteBtn);
                divImages.appendChild(base);
                divImages.appendChild(type);
                cmpImg++;
            }
        })
} 

    