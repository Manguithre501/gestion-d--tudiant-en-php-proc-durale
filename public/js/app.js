const previewImage = (event) => {
    const imageFiles = event.target.files,
        imageFilesLength = imageFiles.length;
    console.log();


    type = imageFiles[0].type;

    if (imageFilesLength > 0 && type === 'image/png' || type === 'image/jpeg')
    {
        const imageSRC = URL.createObjectURL(imageFiles[0]),
            imagePreviewElement = document.querySelector('.preview-selected-image');
        imagePreviewElement.src = imageSRC;
    }
    else
    {
        alert("Cette image n'est pas valable");
     }
    
}