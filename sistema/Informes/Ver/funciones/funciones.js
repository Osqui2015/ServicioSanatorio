$(document).ready(function () {
    const fileList = $('#file-list');

    $('.view-pdf-link').on('click', function (event) {
        event.preventDefault();
        showPDF($(this).data('url'));
    });

    function showPDF(pdfUrl) {
        const pdfViewer = $('#pdfViewer');
        pdfViewer.attr('src', pdfUrl);

        $('#pdfModal').modal('show');
    }
});
document.querySelectorAll('.folder-btn').forEach(folder => {
    folder.addEventListener('click', () => {
        const sublist = folder.nextElementSibling;
        sublist.style.display = sublist.style.display === 'none' ? 'block' : 'none';
    });
});