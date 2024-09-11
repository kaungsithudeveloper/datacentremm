/* Single Preview custom image */
document.addEventListener('DOMContentLoaded', () => {
    const fileInputContainer = document.getElementById('fileInputContainer');
    const photoInput = document.getElementById('photoInput');
    const photoPreview = document.getElementById('photoPreview');
    const fileInputLabel = document.querySelector('.file-input-label');
    const removeButton = document.getElementById('removeButton');

    // Check if there's an existing photo on load
    if (photoPreview.src && !photoPreview.src.includes('profile.jpg')) {
        fileInputLabel.style.display = 'none';
        removeButton.style.display = 'block';
    }

    function previewPhoto(file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            photoPreview.src = e.target.result;
            photoPreview.style.display = 'block';
            fileInputLabel.style.display = 'none';
            removeButton.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }

    // Handle drag and drop events
    fileInputContainer.addEventListener('dragover', (e) => {
        e.preventDefault();
        fileInputContainer.classList.add('dragover');
    });

    fileInputContainer.addEventListener('dragleave', () => {
        fileInputContainer.classList.remove('dragover');
    });

    fileInputContainer.addEventListener('drop', (e) => {
        e.preventDefault();
        fileInputContainer.classList.remove('dragover');
        const file = e.dataTransfer.files[0];
        if (file && file.type.startsWith('image/')) {
            previewPhoto(file);
            photoInput.files = e.dataTransfer.files; // Set the dropped file to the input
        }
    });

    // Handle click event to trigger file input
    fileInputContainer.addEventListener('click', () => {
        photoInput.click();
    });

    // Handle file input change event
    photoInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file && file.type.startsWith('image/')) {
            previewPhoto(file);
        }
    });

    // Remove photo functionality
    removeButton.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        photoPreview.src = '{{ url('upload/profile.jpg') }}';
        photoPreview.style.display = 'block';
        fileInputLabel.style.display = 'block';
        removeButton.style.display = 'none';
        photoInput.value = ''; // Clear the input
    });
});
