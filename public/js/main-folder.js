
const createSubFolder = () => {
    const nameSub = $('#subFolderName').val()
    const fileInput = document.getElementById('subFolderPic');
    const fileName = fileInput.files[0]; // File yang dipilih

    // Buat FormData untuk mengirim data multi-part (termasuk file)
    let formData = new FormData();
    formData.append('nameSub', nameSub); // Nama sub folder
    formData.append('subFolderPic', fileName); // File gambar yang dipilih
    formData.append('idMainFolder', idMain); // File gambar yang dipilih
    formData.append('typeFolder', typeFolderDesc); // File gambar yang dipilih
    formData.append('subFolderId', subFolderId); // File gambar yang dipilih
    $('#exampleModalCenter').modal('hide');
    // Mengirim request menggunakan fetch
    fetch('/api/create-sub-folder', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert('Sub folder created successfully!');
            if(typeFolderDesc == "MainFolder"){
                const folderUrl = `/api/${encodeURIComponent(mainFolderName)}/${idMain}`; // URL dinamis
                window.location.href = '/folders';
            } else {
                const folderUrl = `/api/subfolder/${encodeURIComponent(mainFolderName)}/${idMain}`; // URL dinamis
                window.location.href = '/subfolders';
            }
        } else {
            alert('Failed to create sub folder.');
            $('#exampleModalCenter').modal('show');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}