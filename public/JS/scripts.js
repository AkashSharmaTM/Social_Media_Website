$(document).ready(function() {
    // Password toggle functionality
    $('#togglePassword').click(function() {
        const password = $('#password');
        const type = password.attr('type') === 'password' ? 'text' : 'password';
        password.attr('type', type);
        this.classList.toggle('fa-eye-slash');
    });

    // Add friend functionality
    $('.add-friend').click(function() {
        var friendId = $(this).data('id');
        $.post('../src/add_friend.php', { friend_id: friendId }, function(response) {
            alert(response);
        });
    });
});
