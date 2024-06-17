export function previewOnUpload(imgSelector, inputSelector) {
    $(inputSelector).on('change', (e) => {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                for (const imgElem of $(imgSelector)) {
                    imgElem.src = e.target.result;
                }
            }
            reader.readAsDataURL(file);
        }
    });
}
