$(document).ready(function()
{
    var loadStoreContent = function(url)
    {
        $('#storeSection').load(url + ' #mainArea', function()
        {
            $('#industryBox > .tree > li > a[href*="&param=' + $('#storeThemes').data('param') + '"]').parent().addClass('active');
        });
    }

    var loadPackageContent = function(url)
    {
        $('#packageSection').load(url);
    }


    var storeContentLoaded   = false;
    var packageContentLoaded = false;
    var $loader = $('#storeSection > .load-icon').clone();
    $('#typeNav > li > a[href="#storeSection"]').on('shown.zui.tab', function(e)
    {
        if(!storeContentLoaded)
        {
            loadStoreContent(createLink('ui', 'themestore'));
            storeContentLoaded = true;
        }
    });

    $('#typeNav > li > a[href="#packageSection"]').on('shown.zui.tab', function(e)
    {
        if(!packageContentLoaded)
        {
            loadPackageContent(createLink('ui', 'browsetheme'));
            packageContentLoaded = true;
        }
    });


    $('#storeSection').on('click', '#industryBox a', function(e)
    {
        $('#storeSection').empty().append($loader);
        e.preventDefault();
        loadStoreContent($(this).attr('href'));
    });

    $('.theme').on('click', '.theme-img, .theme-name', function(e)
    {
        e.preventDefault();
        var $this = $(this).closest('.theme');
        if($this.hasClass('current')) return;

        $.getJSON($this.data('url'), function(response)
        {
            if(response.result == 'success')
            {
                $.zui.messager.success(response.message);

                var $themes = $this.closest('.themes');
                $themes.attr('data-theme', $this.data('theme'))
                       .find('.theme.current').removeClass('current');
                $this.addClass('current');

                var $menu = $('#menu');
                $menu.find('.menu-theme-img').attr('src', $this.find('.theme-img img').attr('src'));
                $menu.find('.menu-theme-name').text($this.find('.theme-name').text());
            }
            else
            {
                bootbox.alert(response.message);
            }
        });
    });
});
