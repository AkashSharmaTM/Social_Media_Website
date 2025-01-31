$(document).ready(function() {
    let currentFriendId = null;

    // Load friends list
    $.get('../src/get_friends.php', function(data) {
        $('#friendsList').html(data);
    });

    // Load chat messages
    function loadMessages() {
        if (currentFriendId !== null) {
            $.get('../src/get_messages.php', { friend_id: currentFriendId }, function(data) {
                $('#chatMessages').html(data);
            });
        }
    }

    // Send message
    $('#sendMessage').click(function() {
        const message = $('#message').val();
        if (message.trim() !== '' && currentFriendId !== null) {
            $.post('../src/send_message.php', { friend_id: currentFriendId, message: message }, function(response) {
                $('#message').val('');
                loadMessages();
            });
        }
    });

    // Set friend to chat with
    $(document).on('click', '.friend', function() {
        currentFriendId = $(this).data('id');
        loadMessages();
    });

    // Load messages periodically
    setInterval(loadMessages, 3000);
});
