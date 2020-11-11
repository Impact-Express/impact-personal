const modalBtns = $('.modalBtn');

modalBtns.on('click', function() {
    const ref = $(this).data("ref");
    const modal = $('#modal-'+ref);
    modal.css("display", "block")
    $('#close-'+ref).on('click', function() {
        modal.css("display", "none");
    });
    $('.close-'+ref).on('click', function() {
        modal.css("display", "none");
    });
    $(window).on('click', function(e) {
        if (e.target.id == 'modal-'+ref) {
            modal.css("display", "none");
        }
    });
});
