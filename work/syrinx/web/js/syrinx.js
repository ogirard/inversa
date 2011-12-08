/* JavaScripts for www.syrinx.ch */

$(document).ready(function() {
    InitTabs();
    SetMinHeight();
    UnpackEmails();
});

var selectedTabId = null;

function InitTabs()
{
    $(".tab").hover(OnTabMouseOver, OnTabMouseOut);
}

function SetMinHeight()
{
    var diffHeight = $(".container").height() - $(".syrinxcontent").height();
    var height = $(document).height() - diffHeight - 5;
    $(".syrinxcontent").css("min-height", height + "px");
}

function GetById(id)
{
    return $("#" + id);
}

function OnTabMouseOver()
{
    if(selectedTabId == $(this).id && selectedTabId != null) return;
    $(this).addClass("tabover");
    $(this).removeClass("tab");
}

function OnTabMouseOut()
{
    if(selectedTabId == $(this).id  && selectedTabId != null) return;
    $(this).removeClass("tabover");
    $(this).addClass("tab");
}

function OnTabClick(id)
{
    document.location = GetById(id).attr('href');
}

function CheckId(id)
{
    if(id == "") return false;
    if(selectedTabId == id) return false;
    if(GetById(id) == null) return false;
    return true;
}

function SelectTab(id)
{
    DeSelectTab(selectedTabId);
    selectedTabId = id;
    GetById(id).removeClass("tab");
    GetById(id).addClass("tabselected");
}

function DeSelectTab(id)
{
    if(id == "") return;
    
    GetById(id).removeClass("tabselected");
    GetById(id).addClass("tab");	
}

function UnpackEmails()
{
    $('a.aaa').each(function() {
        e = this.rel.replace('/','@');
        this.href = 'mailto:' + e;
        $(this).text(e);
    });
}
