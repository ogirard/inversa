$(document).ready(function() {
    SetMinHeight();
    UnpackEmails();
});

function SetMinHeight()
{
    var diffHeight = $(".container").height() - $(".inversacontent").height();
    var height = $(document).height() - diffHeight - 5 - 35; // -35: debug panel, remove for prod!
    $(".inversacontent").css("min-height", height + "px");
}

function UnpackEmails()
{
    $('a.aaa').each(function() {
        e = this.rel.replace('/','@');
        this.href = 'mailto:' + e;
        $(this).text(e);
    });
}