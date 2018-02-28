$(document).ready(function()
{
    $.setAjaxForm('#editForm', function(response) 
    {
        if(response.result == 'fail')
        {
            bootbox.alert(response.warning);
        }
        if(response.result == 'success')
        {
            setTimeout(function()
            {
                location.href = response.locate;  
            }, 2000);
        }
    });

    $.setAjaxLoader('.okFile', '#ajaxModal');

    $('#resetBtn').click(function()
    {
        $('#content').val($('#rawContent').val());
        $('#editForm').submit();
    });

    btn = $('.btn-file.active');
    file = btn.parents('.panel').find('span').html() + ' / ' + btn.html();
    $('#fileName').prepend(file);

    $('.panel-folder').each(function()
    {
        $(this).toggle($(this).find('a.active').size() > 0);
        if($(this).find('a.active').size() > 0)
        {
            $(this).css("display", "block");
        }
    });

    $('.folder-menu').find('.panel-heading').click(function()
    {
        $('.folder-menu .panel-folder').hide(); 
        $(this).next().show();
    });

    var extraHeight = $('#mainNavbar').outerHeight() + $('#menu').outerHeight() + $('#mainPanel > .panel-heading').outerHeight() + $('#mainPanel > .panel-footer').outerHeight() + 80;;
    var resizeEditors = function()
    {
        $('.codeeditor').each(function()
        {
            var options = $(this).data();
            var height = Math.max(100, $(window).height() - extraHeight);
            $('#' + options.editorId).height(height);
            options.editor.resize();
            console.log(options, height);
        });
    };

    $(window).on('resize', resizeEditors);
    resizeEditors();
});
