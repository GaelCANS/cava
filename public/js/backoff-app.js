$(function() {

    indexFilter()

    // Alert on invitation button
    $('.invitation').click(function() {
        if (!confirm('Voulez-vous envoyer les invitations par email ?'))
            return false
    });

    /**
     * Survey
     */
    $('.comments-content').scroll(function () {
        if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
            var obj = $('.opened-comment')
            loadComments(obj)
            obj.data('from',obj.data('from')+obj.data('range'))
        }
    })

    /**
     * Survey
     */
    $('.table').on('click','.open-comments',function () {
        event.preventDefault()
        $('.opened-comment').removeClass('opened-comment')
        displayComments($(this))
        $(this).data('from',$(this).data('from')+$(this).data('range'))
        $(this).addClass("opened-comment")
    })

    /**
     * Common
     */
    $('.add-btn').on('click' , function () {
        window[_.camelCase('add '+$(this).data('type'))]($(this).data('link'),$(this).data('id'))
    })

    /**
     * Common
     */
    $('html').on('click','a.confirm',function () {
        event.preventDefault()
        if(confirm($(this).data('confirm'))) {
            window.location.href = $(this).attr('href')
        }
    })

    /**
     * Blueprint
     */
    $('.ajax-survey').on('change',function () {
        updateBlueprint($(this))
    })

    /**
     * Survey
     */
    $('.table').on('change','.ajax-date',function () {
        updateSurvey($(this))
    })

    /**
     * Question
     */
    $('.table').on('change','.ajax-radio',function () {
        updateQuestion($(this))
    })

    /**
     * Question
     */
    $('.table').on('change','.ajax-text',function () {
        updateQuestion($(this))
    })

    /**
     * User
     */
    $('.table').on('keyup','.ajax-user',function () {
        updateUser($(this))
    })

    /**
     * User
     */
    $('.table').on('keyup','.error',function () {
        removeError($(this))
    })
    $('.modal').on('keyup','.error',function () {
        removeError($(this))
    })
    $('#blueprint-form').on('keyup','.error',function () {
        removeError($(this))
    })

    /**
     * Question
     */
    $(".sortable").sortable({
        placeholder: "ui-state-highlight",
        stop: refreshQuestionOrder,
    })

    /**
     * Survey
     */
    $('.table').on('click','.show-users',function () {
        showUsers($(this))
    })

    /**
     * Blueprint
     */
    $('.cartouche').on('click',function () {
        addField($(this).data('name'))
    })


    /**
     * Commun
     *
     */
    initDatepicker();


    $('.contributors').click(function() {

        var key = $(this).data('key')
        var href = $(this).data('href')

        $.ajax({
                method: "GET",
                url: href,
                data: {key : key}
            })
            .done(function( data ) {
                $('#users .modal-body').html(data.html)
            })
        })

    $('.table').on('click','.del-btn',function () {
        event.preventDefault()
        if(confirm($(this).data('confirm'))) {
            window.location.href = $(this).attr('href')
        }
    })

})


/**
 * Common
 */
function initDatepicker()
{
    $.fn.datepicker.dates['fr'] = {
        days: ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"],
        daysShort: ["Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam"],
        daysMin: ["Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa"],
        months: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"],
        monthsShort: ["Jan", "Fév", "Mar", "Avr", "Mai", "Juin", "Juil", "Aoû", "Sep", "Oct", "Nov","Déc"],
    }

    $('.datepicker').datepicker({
        language: 'fr',
        format: 'dd/mm/yyyy',
        autoclose: true,
        weekStart:1,
        daysOfWeekHighlighted: '0,6'
    })

    // Auto open begin datepicker & on select date begin auto open end datepicker and set the min day selectable
    $('[data-name="begin"]').on('changeDate', function(e) {
        var end = $(this).closest('tr').find('[data-name="end"]')
        end.datepicker('setStartView' , $(this).val())
        end.datepicker('setStartDate' , $(this).val())
        end.datepicker('show')
    })
}


/**
 * Surveys
 */
function addIteration(link,id)
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        method: "POST",
        url: link,
        data: {id:id}
    })
    .done(function( data ) {
        $( ".table tbody" ).append( data.html )
        initDatepicker()
        $('.table tbody tr:last-child input[data-name="begin"]').datepicker('show')
    })
}


/**
 * Questions
 */
function addQuestion(link,id)
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        method: "POST",
        url: link,
        data: {id:id}
    })
    .done(function( data ) {
        $( "#container-questions" ).append( data.html )
        $('#container-questions').sortable({
            placeholder: "ui-state-highlight",
            stop: refreshQuestionOrder,
        })
    })
}

/**
 * Users
 */
function addUserModal() {
    $('#add-user-modal').modal('show')
}

/**
 * Users
 */
function addUser(link,id)
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Autocomplete fields
    autocompleteAddUser()

    // Check on field on create user
    var next = true
    $('#add-user-modal .form-control').each(function () {
        next = userError($(this)) == false ? false : next
    })
    if (next == false) return false;

    $.ajax({
        method: "POST",
        url: link,
        data: {email:$('#input-email').val(),lastname:$('#input-lastname').val(),firstname:$('#input-firstname').val(),blueprint_id:id}
    })
    .done(function( data ) {
        $( ".table tbody" ).append( data.html )
        $('#add-user-modal').modal('hide')
        $('#add-user-modal .form-control').val('')
    })
}

/**
 * Users
 */
function autocompleteAddUser()
{
    var baseEmail = $('#input-email').val().split('@')
    var splitName = baseEmail[0].split('.')
    $('#input-lastname').val(splitName[1])
    $('#input-firstname').val(splitName[0])
    $('#input-email').val(baseEmail[0]+'@ca-normandie-seine.fr')
}

/**
 * Surveys
 */
function updateSurvey(obj) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        method: "POST",
        url: $('#survey-form').attr('action'),
        data: {id:obj.data('id'),name:obj.data('period'),value:obj.val()}
    })
    .done(function( data ) {

    })
    .fail(function (data) {
        obj.addClass('error')
    })
}

/**
 * Surveys
 */
function updateBlueprint(obj) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        method: "PUT",
        url: $('#blueprint-form').attr('action'),
        data: {id:obj.data('id'),name:obj.data('name'),value:obj.val()}
    })
    .done(function( data ) {

    })
    .fail(function (data) {
        obj.addClass('error')
    })
}

/**
 * Questions
 */
function updateQuestion(obj) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        method: "POST",
        url: $('#question-form').attr('action'),
        data: {id:obj.parents('li').data('id'),name:obj.data('name'),value:obj.val()}
    })
    .done(function( data ) {

    })
    .fail(function (data) {
        obj.addClass('error')
    })
}

/**
 * User
 */
function updateUser(obj) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Gestion des errors
    if ( !userError(obj) ) {
        return false;
    }

    $.ajax({
        method: "POST",
        url: obj.parents('tr').data('link'),
        data: {id:obj.parents('tr').data('id'),name:obj.data('name'),value:obj.val()}
    })
    .done(function( data ) {

    })
    .fail(function (data) {
        obj.addClass('error')
    })
}

/**
 * User
 * @param obj
 * @returns {boolean}
 */
function userError(obj)
{
    // Si le champs saisit est vide
    if (_.trim(obj.val()) == '') {
        obj.addClass('error');
        return false;
    }

    // Si le champs est un email mais que le format n'est pas bon
    if (obj.data('name') == 'email' && !validateEmail(obj.val())) {
        obj.addClass('error');
        return false;
    }

    return true;
}

/**
 * User
 * @param obj
 * @returns {boolean}
 */
function removeError(obj)
{
    // Si le champs saisit n'est pas vide
    if (_.trim(obj.val()) != '') {
        obj.removeClass('error');
    }

    // Si le champs est un email mais que le format n'est pas bon
    if (obj.data('name') == 'email' && validateEmail(obj.val())) {
        obj.removeClass('error');
    }

    // Si le champs est un emails mais que les emails n'ont pas format correct
    /*if (obj.data('name') == 'emails') {
        console.log('coucou')
    }*/

}

/**
 * Questions
 */
function refreshQuestionOrder() {
    var ids = [];
    $('#container-questions li').each(function(){
        ids.push($(this).data('id'))
    })

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        method: "POST",
        url: $('#question-form').attr('refresh'),
        data: {ids:ids}
    })
    .done(function( data ) {

    })
}

/**
 * Surveys
 */
function showUsers(obj) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        method: "GET",
        url: obj.parent('tr').data('link'),
        data: {}
    })
    .done(function( data ) {
        $('#users-modal .modal-body').html(data.html)
        $('#users-modal .data-survey').html(data.date)
        $('#users-modal').modal('show')
    })
}

/**
 * Common
 * @param email
 * @returns {boolean}
 */
function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

/**
 * Index
 */
function indexFilter() {
    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase()
        $("#blueprints tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        })
    })
}


/**
 * Survey
 */
function loadComments(obj)
{
    displayComments(obj)
}

/**
 * Survey
 */
function displayComments(obj)
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
            method: "GET",
            url: obj.attr('href'),
            data: {from: obj.data('from'), range: obj.data('range')}
        })
        .done(function( data ) {
            if (data.from == 0) {
                $('#comments-modal .modal-body .comments-content ul').html(data.html)
            }
            else {
                $('#comments-modal .modal-body .comments-content ul').append(data.html)
            }
            $('#comments-modal').modal('show')
        })
}


/**
 * Blueprint
 */
function addField(value) {

    switch (value) {
        case 'survey':
            var html = '%%--link_survey--%%'
            break
        case 'results':
            var html = '%%--link_results--%%'
            break
        case 'duree':
            var html = '%%--days--%%'
            break
    }

    insertAtCaret('intro',html)
    updateBlueprint($('#intro'))
}

/**
 * Common
 * @param areaId
 * @param text
 */
function insertAtCaret(areaId, text) {
    var txtarea = document.getElementById(areaId);
    if (!txtarea) {
        return;
    }

    var scrollPos = txtarea.scrollTop;
    var strPos = 0;
    var br = ((txtarea.selectionStart || txtarea.selectionStart == '0') ?
        "ff" : (document.selection ? "ie" : false));
    if (br == "ie") {
        txtarea.focus();
        var range = document.selection.createRange();
        range.moveStart('character', -txtarea.value.length);
        strPos = range.text.length;
    } else if (br == "ff") {
        strPos = txtarea.selectionStart;
    }

    var front = (txtarea.value).substring(0, strPos);
    var back = (txtarea.value).substring(strPos, txtarea.value.length);
    txtarea.value = front + text + back;
    strPos = strPos + text.length;
    if (br == "ie") {
        txtarea.focus();
        var ieRange = document.selection.createRange();
        ieRange.moveStart('character', -txtarea.value.length);
        ieRange.moveStart('character', strPos);
        ieRange.moveEnd('character', 0);
        ieRange.select();
    } else if (br == "ff") {
        txtarea.selectionStart = strPos;
        txtarea.selectionEnd = strPos;
        txtarea.focus();
    }

    txtarea.scrollTop = scrollPos;
}