const uploadFile = (file, title, body) => {
    const url = 'php/validate-publi.php';  
    const formData = new FormData();

    // Añade los datos del archivo y los inputs al objeto FormData
    formData.append('file', file);
    formData.append('title', title);
    formData.append('body', body);


    const xhr = new XMLHttpRequest();

    // Event listener for upload progress
    xhr.upload.addEventListener('progress', (event) => {
        if (event.lengthComputable) {
            const percentComplete = event.loaded / event.total * 100;
            console.log(`File upload progress: ${percentComplete}%`);

            // Actualiza tu interfaz de usuario con percentComplete aquí
            // Asume que tienes un elemento con id 'uploadProgress' donde quieres mostrar el progreso
        }
    }, false);

    // Event listener for upload completion
    xhr.addEventListener('load', (event) => {
        if (xhr.status === 200) {
            let subido=document.querySelector('.archivo-subido');
            subido.style.display='flex';
            let loading=document.querySelector('.loading-publi');
            loading.style.display='none';
            console.log(this.responseText);
            // Actualiza tu interfaz de usuario para reflejar la finalización de la carga aquí
        } else {
            let subido=document.querySelector('.archivo-fallido');
            subido.style.display='flex';
            let loading=document.querySelector('.loading-publi');
            loading.style.display='none';
            console.log('File upload failed.');
        }
    }, false);

    // Inicia la subida del archivo
    xhr.open('POST', url, true);
    xhr.send(formData);
}

const handleFileUpload = (event) => {
    event.preventDefault();
    let loading=document.querySelector('.loading-publi');
    loading.style.display='flex';
    console.log('flex loading');
    const file = document.querySelector("#file").files[0];
    const title = document.querySelector("#title").value;
    const body = document.querySelector("#body").value;


    uploadFile(file, title, body);
}

document.querySelector(".public_button").addEventListener('click', handleFileUpload);
