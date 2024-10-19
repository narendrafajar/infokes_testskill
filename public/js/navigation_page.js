const randomId = () => {
	// Math.random should be unique because of its seeding algorithm.
	// Convert it to base 36 (numbers + letters), and grab the first 9 characters
	// after the decimal.
	return '_' + Math.random().toString(36).substr(2, 9);
}

const createFolder = () => {

    $('#btnAddFolder').hide('slow');

     // Dapatkan panjang list folder saat ini
     const mainFolderList = document.getElementById('main-folder-list');
     const tempId = randomId(); // Fungsi untuk membuat ID sementara
 
     // Membuat elemen <li> baru untuk folder baru
     const li = document.createElement('li');
     li.classList.add('nav-item');  // Menambahkan class nav-item
     li.setAttribute('id', tempId); // Set ID sementara untuk elemen ini
 
     // Membuat input untuk memasukkan nama folder
     const input = document.createElement('input');
     input.setAttribute('type', 'text');
     input.setAttribute('placeholder', 'Enter folder name');
     input.setAttribute('id', 'input-folder-name');
     input.setAttribute('class', 'form-control');
     $('#input-folder-name').focus();
     // Membuat tombol untuk menyimpan folder
     const saveButton = document.createElement('button');
     saveButton.textContent = 'Save';
     
     // Event ketika tombol save di klik
     saveButton.addEventListener('click', async () => {
        const folderName = input.value.trim(); // Ambil nama folder dari input
        if (folderName === '') {
            alert('Folder name cannot be empty!');
            return;
        }
    
        try {
            // Kirim data ke server menggunakan fetch (POST request)
            const createFolderResponse = await fetch('/api/create-folder', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ nameFolder: folderName })
            });
    
            const createFolderData = await createFolderResponse.json();
    
            if (createFolderData.status === 'success') {
                // Akses elemen terakhir dalam array 'main' yang mungkin merupakan folder baru
                const newFolder = createFolderData.data.main[createFolderData.data.main.length - 1];
    
                if (newFolder) {
                    // Buat linkFolder dengan format namaFolder/id
                    const linkFolder = `${folderName}/${newFolder.id}`;
    
                    // Kirim linkFolder kembali ke server untuk disimpan
                    const saveLinkResponse = await fetch('/api/save-link-folder', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ id: newFolder.id, linkFolder: linkFolder })
                    });
    
                    const saveLinkData = await saveLinkResponse.json();
                    if (saveLinkData.status === 'success') {
                        window.location.href = '/folders'; // Redirect ke dashboard setelah berhasil
                    } else {
                        alert('Failed to save link folder');
                    }
                } else {
                    alert('No folder returned from server');
                }
            } else {
                alert('Failed to create folder');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('An error occurred while creating the folder');
        }
    });
    
    // Menambahkan input dan tombol ke dalam li
    li.append(input);
    li.append(saveButton);
    
    // Menambahkan li ke dalam daftar folder
    mainFolderList.append(li);
}


fetch('/api/dashboard')
        .then(response => response.json())
        .then(data => {
            // Debug untuk melihat struktur data
            // console.log('API response:', data);

            // Cek apakah data.data adalah array
            if (data.status === 'success' && Array.isArray(data.data.main)) {
                const list = document.getElementById('main-folder-list');
                data.data.main.forEach(folder => {
                    if (folder.folder_name) {
                        const folderUrl = `/api/${encodeURIComponent(folder.folder_name)}/${folder.id}`; // URL dinamis
                        // console.log(folder.folderSub);
                        const listItem = document.createElement('li');
                            listItem.setAttribute('class','nav-item');
                            const aHref = document.createElement('a');
                            aHref.setAttribute('href','/folders#');
                            aHref.setAttribute('class','.folder');
                            aHref.setAttribute('onclick', `fetchFolderData('${folder.folder_name}', ${folder.id})`);
                            aHref.textContent = folder.folder_name;

                            const creteColpaseDiv = document.createElement('div');
                            creteColpaseDiv.setAttribute('class','collapse show');

                            const creteUlSub = document.createElement('ul');
                            
                            creteUlSub.setAttribute('class','nav nav-collapse');
                            if (folder.folderSub) {
                                folder.folderSub.forEach(subFolder =>{
                                    const creteLiSub = document.createElement('li');// Untuk subfolder
                                    
                                    const aHrefLev3 = document.createElement('a');
                                    aHrefLev3.setAttribute('href','/subfolders#');
                                    aHrefLev3.setAttribute('class','.folder');
                                    aHrefLev3.setAttribute('onclick', `fetchSubFolderData('${subFolder.sub_folder_name}', ${subFolder.id})`);
                                    aHrefLev3.textContent = subFolder.sub_folder_name;
    
                                    creteLiSub.append(aHrefLev3);
                                    creteUlSub.append(creteLiSub);
                                })
                            }
                            creteColpaseDiv.append(creteUlSub);
                            listItem.append(aHref);
                            listItem.append(creteColpaseDiv);
                            list.append(listItem); 
                         
                    }
                });
                const brElement = document.createElement('br');
                 // Membuat elemen <center> untuk membungkus tombol
                const centerElement = document.createElement('center');

                // Membuat tombol untuk menambah folder
                const createButtonAdd = document.createElement('button');
                createButtonAdd.setAttribute('id', 'btnAddFolder');
                createButtonAdd.setAttribute('type', 'button');
                createButtonAdd.setAttribute('class', 'btn btn-primary btn-rounded');
                createButtonAdd.setAttribute('onclick', 'createFolder()');
                createButtonAdd.textContent = 'Buat Folder';

                // Menambahkan tombol ke dalam elemen <center>
                centerElement.append(createButtonAdd);

                // Menambahkan <center> yang berisi tombol ke list atau elemen lain yang sesuai
                list.append(brElement);
                list.append(centerElement);
            } else {
                console.error('Error: data.data is not an array.');
            }
        })
        .catch(error => console.error('Error:', error));

function fetchFolderData(folderName, id) {
    // window.location.href = '/folders';
    const folderUrl = `/api/${encodeURIComponent(folderName)}/${id}`;
    fetch(folderUrl)
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                // console.log(data.data,'abc');
                // window.location.href = '/folders';
                displayFolders(data.data);
            } else {
                alert(data.message); // Tampilkan pesan kesalahan
            }
        })
        .catch(error => {
            console.error('Error fetching folder data:', error);
        });
}

function fetchSubFolderData(SubfolderName, id) {
    // window.location.href = '/folders';
    const folderUrl = `/api/subfolder/${encodeURIComponent(SubfolderName)}/${id}`;
    fetch(folderUrl)
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                // console.log(data.data,'sub folder');
                // window.location.href = '/folders';
                displayFolders(data.data);
            } else {
                alert(data.message); // Tampilkan pesan kesalahan
            }
        })
        .catch(error => {
            console.error('Error fetching folder data:', error);
        });
}

var idMain = "";
var mainFolderName = "";
var typeFolderDesc = "";
var subFolderId = "";

function displayFolders(data) {
    // console.log(data,'displayFolders');
   const titleContent = document.getElementById('titleContent');
   if (titleContent) {
        if (data.typeFolderLevel == "MainFolder") {
            titleContent.textContent = data.main.folder_name; // Element untuk judul
            typeFolderDesc = "MainFolder"
            idMain = data.main.id;
        } else {
            titleContent.textContent = data.mainFolderName + ' / ' + data.main.sub_folder_name; // Element untuk judul
            typeFolderDesc = "SubFolder"
            subFolderId =  data.main.id
            idMain = data.main.main_folder_id;
        }
        
    } else {
        console.error('titleContent element not found.');
    }
   const isiContent = document.getElementById('isiFolder');
   if (!isiContent) {
    console.error('isiFolder element not found.');
    return; // Exit if the element does not exist
    }
   mainFolderName = data.main.folder_name;
   $('#buttonDock').show('slow');
   
   isiContent.innerHTML = '';
   if(data.subFolder.length > 0){
        data.subFolder.forEach(folderSub => {
            const rowItems = document.getElementById('isiFolder');

            // Buat elemen div untuk tiap item
            const classMdItems = document.createElement('div');
            classMdItems.setAttribute('class', 'col-sm-12 col-md-6 col-lg-3 text-center'); // Menambahkan text-center untuk meratakan teks

            // Buat elemen gambar
            const imageSubfolder = document.createElement('img');
            imageSubfolder.setAttribute('src', 'storage/' + folderSub.sub_folder_image); // Mengambil URL yang disimpan di database
            imageSubfolder.setAttribute('alt', folderSub.sub_folder_name);
            imageSubfolder.setAttribute('class', 'img-fluid');
            imageSubfolder.setAttribute('width', '75px');
            imageSubfolder.setAttribute('height', '75px');

            // Buat elemen tautan (link) untuk nama sub-folder
            const linkItem = document.createElement('a');
            // linkItem.setAttribute('href', `/subfolder/${folderSub.id}`); // Ganti dengan URL yang sesuai untuk sub-folder
            // linkItem.setAttribute('class', 'mt-2'); // Menambahkan kelas untuk styling
            linkItem.setAttribute('href','/subfolders#');
            linkItem.setAttribute('class','.folder mt-2');
            linkItem.setAttribute('onclick', `fetchSubFolderData('${folderSub.sub_folder_name}', ${folderSub.id})`);

            // Buat elemen teks (nama folder)
            const textItem = document.createElement('p');
            textItem.textContent = folderSub.sub_folder_name; // Menggunakan nama sub-folder dari database

            // Tambahkan teks ke dalam link
            linkItem.appendChild(textItem);

            // Tambahkan gambar dan tautan ke dalam div
            classMdItems.append(imageSubfolder);
            classMdItems.append(linkItem);

            // Tambahkan div ke dalam row
            rowItems.append(classMdItems);
        });
   }
}
        // Event listener untuk klik folder
// document.querySelectorAll('.folder').forEach(folder => {
//     folder.addEventListener('click', () => {
//         const folderName = folder.dataset.folderName; // Ambil nama folder dari data atribut
//         const id = folder.dataset.id; // Ambil ID dari data atribut
//         fetchFolderData(folderName, id);
//     //    window.location.href = '/folders';
//     });
// });
