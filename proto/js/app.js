var app = angular.module('myDashboard', ['ngRoute'])

app
.config(function($routeProvider) {
    $routeProvider
    .when('/', {
        templateUrl: 'pages/home.html',
        controller: 'HomeController'
    })
    .when('/grade-book', {
        templateUrl: 'pages/grade-book.html',
        controller: 'GradeBookController'
    })
    .when('/statistics', {
        templateUrl: 'pages/statistics.html',
        controller: 'StatisticsController'
    })
    .when('/upload-marks', {
        templateUrl: 'pages/upload-marks.html',
        controller: 'UploadMarksController'
    })
    .otherwise({redirectTo: '/'})
})
.run(function($rootScope, $location, $routeParams) {

    // after page loaded successfully
    $rootScope.$on('$routeChangeSuccess', function() {

        // stop spinner
        $('#dashboard-spinner').animate({
            opacity: 'toggle'   
        }, 500, function() {
            $('#dashboard-spinner').attr('class', '')
        })

        // visual change change active tab
        var path = $location.path().substr(1)

        if (path === '') {
            $('li').attr('class', '')
            $('#home-tab').attr('class', 'active')
        }
        else if (path === 'grade-book') {
            $('li').attr('class', '')
            $('#grade-book-tab').attr('class', 'active')
        }
        else if (path === 'statistics') {
            $('li').attr('class', '')
            $('#statistics-tab').attr('class', 'active')
        }
        else if (path === 'upload-marks') {
            // set active tab
            $('li').attr('class', '')
            $('#upload-marks-tab').attr('class', 'active')
        }
    })
    //
    $rootScope.$on('$routeChangeStart', function() {

        // if sidebar is hidden spin in the middle of content
        if ($('#sidebar').css('margin-left') == '-260px') {
            $('#dashboard-spinner').css('left', ($(window).width()/2) -32)
        }
        else {
            $('#dashboard-spinner').css('left', 'calc((100vw - 260px)/2 + 260px - 32px)')
        }
        $('#dashboard-spinner').attr('class', 'lds-dual-ring')
    })
})
// controls and binds data for the home page
.controller('HomeController', function($scope, $http) {

    /**
     * set up user interface
     */
    $scope.title = 'Home'

    // init variables - change on resize
    var iWinHeight = $(window).height()

    // profile card card
    var profileCardHeight = 0.5 * (iWinHeight - $('#profile-card').offset().top - 10)
    $('#profile-card').css('height', profileCardHeight)
    // recent card card
    var recentCardHeight = 0.5 * (iWinHeight - $('#recent-card').offset().top - 10)
    $('#recent-card').css('height', recentCardHeight)
    // notifications card height
    var notificationCardHeight = iWinHeight - $('#notification-card').offset().top - 10
    $('#notification-card').css('height', notificationCardHeight)
    // graph card height
    var graphCardHeight = iWinHeight - $('#graph-card').offset().top - 10
    $('#graph-card').css('height', graphCardHeight)

    // toggle sidebar on click
    $scope.sidebar = function() {
        $('#sidebar').toggleClass('active')
    }

    $(window).on('resize', function() {
        // window heigh changed on resize
        var iWinHeight = $(window).height()

        // profile card card
        var profileCardHeight = 0.5 * (iWinHeight - $('#profile-card').offset().top - 10)
        $('#profile-card').css('height', profileCardHeight)
        // recent card card
        var recentCardHeight = 0.5 * (iWinHeight - $('#recent-card').offset().top - 10)
        $('#recent-card').css('height', recentCardHeight)
        // notifications card height
        var notificationCardHeight = iWinHeight - $('#notification-card').offset().top - 10
        $('#notification-card').css('height', notificationCardHeight)
        // graph card height
        var graphCardHeight = iWinHeight - $('#graph-card').offset().top - 10
        $('#graph-card').css('height', graphCardHeight)
    })
//-----------------------------------------------------------------------------

    /**
     * get data base data
     */
    // get variables from database
    $http.post('../api/signing/signed.php')
    .then(function(response) {

        if (response.data.message === 'success') {
            
            // get subjects
            $http.get('../api/basic/subject.php?user_id=' +
                response.data.contents.user_id)
            .then(function(responses) {
                // subjects
                $scope.subjects = responses.data.contents
            })

            // get lookup table data
            $http.get('../api/basic/lookup.php')
            .then(function(responsible) {
                // lookups
                $scope.utl = responsible.data.contents.user_type_lookup
                $scope.ail = responsible.data.contents.assessment_info_lookup
                $scope.aml = responsible.data.contents.assessment_medium_lookup
                $scope.atl = responsible.data.contents.assessment_type_lookup
            })

        }
        else {
            window.location.href = '../'
        }
    })
})

/**
 * grade book view
 */
.controller('GradeBookController', function($scope) {
    $scope.title = 'Grade Book'

    // toggle sidebar on click
    $scope.sidebar = function() {
        $('#sidebar').toggleClass('active')
    }
})

/**
 * statistics view
 */
.controller('StatisticsController', function($scope) {
    $scope.title = 'Statistics'

    // toggle sidebar on click
    $scope.sidebar = function() {
        $('#sidebar').toggleClass('active')
    }
})

/**
 * upload marks view
 */
.controller('UploadMarksController', function($scope, $http, $timeout) {

    /**
     * set up user interface
     */
    // get variables from database
    $http.post('../api/signing/signed.php')
    .then(function(response) {

        if (response.data.message === 'success') {
            
            // get subjects
            $http.get('../api/basic/subject.php?user_id=' +
                response.data.contents.user_id)
            .then(function(responses) {
                // subjects
                $scope.subjects = responses.data.contents
            })

            // get lookup table data
            $http.get('../api/basic/lookup.php')
            .then(function(responsible) {
                // lookups
                $scope.utl = responsible.data.contents.user_type_lookup
                $scope.ail = responsible.data.contents.assessment_info_lookup
                $scope.aml = responsible.data.contents.assessment_medium_lookup
                $scope.atl = responsible.data.contents.assessment_type_lookup
            })

        }
        else {
            window.location.href = '../'
        }
    })

    $scope.title = 'Upload Marks'
    $scope.sidebar = function() {
        $('#sidebar').toggleClass('active')
    }
    // file preview border-bottom to bottom of window
    var card = $('#config-card')
    var height = $(window).height() - card.offset().top - 10
    card.css('height', height)
    // display area border-bottom to bottom of file preview
    var area = $('#display-area')
    var areaHeight = $(window).height() - area.offset().top - 20
    area.css('height', areaHeight)

    // local variables
    var csv = ''

    // for custom drop down menu
    angular.element(function() {

        $timeout(function() {

            /** wait for elements to be loaded
             * for further understanding visit
             * https://www.w3schools.com/howto/howto_custom_select.asp
             */
            // variables
            var x, i, j, selElmnt, a, b, c
            
            // look for any elements with the class 'dropdown-menu'
            x = document.getElementsByClassName('dropdown-menu')
            
            // loop through each element with class 'dropdown-menu
            for (i = 0; i < x.length; i++) {

                //<select><option></option> ... <option></option></select>
                selElmnt = x[i].getElementsByTagName('select')[0]

                // for each element, create a new DIV that will act as the selected item
                a = document.createElement('DIV')
                a.setAttribute('class', 'select-selected')
                a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML
                x[i].appendChild(a)

                // for each element, create a new <div> that will contain the option list
                b = document.createElement('DIV')
                b.setAttribute('class', 'select-items select-hide')

                for (j = 1; j < selElmnt.length; j++) {

                    // for each option in the original select element,
                    // create a new <div> that will act as an option item
                    c = document.createElement('DIV')
                    c.innerHTML = selElmnt.options[j].innerHTML

                    // on option clicked
                    c.addEventListener('click', function(e) {

                        // when an item is clicked, update the original select box,
                        // and the selected item
                        var y, i, k, s, h
                        s = this.parentNode.parentNode.getElementsByTagName('select')[0]
                        h = this.parentNode.previousSibling

                        for (i = 0; i < s.length; i++) {
                            if (s.options[i].innerHTML == this.innerHTML) {

                                s.selectedIndex = i

                                if (this.innerHTML.length > 15) {
                                    h.innerHTML = this.innerHTML.substr(0, 12) + '...'
                                }
                                else {
                                    h.innerHTML = this.innerHTML
                                }

                                y = this.parentNode.getElementsByClassName('same-as-selected')

                                for (k = 0; k < y.length; k++) {
                                    y[k].removeAttribute('class')
                                }

                                this.setAttribute('class', 'same-as-selected')
                                break
                            }
                        }
                        h.click()
                    })

                    b.appendChild(c)
                }

                x[i].appendChild(b)
                a.addEventListener('click', function(e) {

                    // when the select box is clicked, close any other select boxes,
                    // and open/close the current select box
                    e.stopPropagation()
                    closeAllSelect(this)

                    this.nextSibling.classList.toggle('select-hide')
                    this.classList.toggle('select-arrow-active')
                })
            }

            function closeAllSelect(elmnt) {
                // a function that will close all select boxes in the document,
                // except the current select box:*/

                var x, y, i, arrNo = []
                x = document.getElementsByClassName('select-items')
                y = document.getElementsByClassName('select-selected')

                for (i = 0; i < y.length; i++) {
                    if (elmnt == y[i]) {
                        arrNo.push(i)
                    }
                    else {
                        y[i].classList.remove('select-arrow-active')
                    }
                }

                for (i = 0; i < x.length; i++) {
                    if (arrNo.indexOf(i)) {
                        x[i].classList.add('select-hide')
                    }
                }
            }

            // if the user clicks anywhere outside the select box,
            //then close all select boxes
            document.addEventListener('click', closeAllSelect)
        }, 500)
    })
    $(window).on('resize', function() {

        // adjusts bottom-border of file preview card
        if ($('#config-card').length === 1 && $('#display-area').length == 1) {
            var wheight = $(window).height() - $('#config-card').offset().top - 10;
            var warea = $(window).height() - $('#display-area').offset().top - 20;
            $('#config-card').css('height', wheight)
            $('#display-area').css('height', warea)
        }
    })

//-----------------------------------------------------------------------------
    /**
     * form handling
     */
    // user clicks publish
    $scope.publish = function() {

        // form variables
        var name = $('#assessment-name').val()
        var date = $('#assessment-date').val()
        var weight = $('#assessment-weight').val()
        var total = $('#assessment-total').val()
        var course = $('#course-id').val()
        var ail = $('#ail-id').val()
        var aml = $('#aml-id').val()
        var atl = $('#atl-id').val()

        if (name.length === 0 || total.length === 0 || weight.length === 0 || csv.length === 0 || date.length === 0
            || !(ail > 0) || !(aml > 0) || !(atl > 0) || !(course > 0)) {
                // fill in all fields show pop up
                $('#drop-pop').css('color', 'red')
                $('#drop-pop').css('border-color', 'red')
                // position in middle
                if ($('#sidebar').css('margin-left') == '-260px') {
                    var left = $(window).width()/2 - 128
                    $('#drop-pop').css('left', left)
                }
                else {
                    var left = $(window).width() - 260
                    left = left/2 + 260 - 128
                    $('#drop-pop').css('left', left)
                }
                $('#drop-pop').html('FILL IN ALL FIELDS')
                $('#drop-pop').animate({
                    opacity: '1'   
                }, 100, function() {
                    $('#drop-pop').animate({
                        opacity: '1'   
                    }, 2500, function() {
                        $('#drop-pop').animate({
                            opacity: '0'   
                        }, 250, function() {
                            $('#drop-pop').css('color', '#3472F7')
                            $('#drop-pop').css('border-color', '#3472F7')
                            $('#drop-pop').html('DROP FILE HERE')
                        })
                    })
                })

        }
        else {
            // publish results
            var url = '../api/assessments/add.php?assessment_name=' 
            + name + '&assessment_weight=' 
            + weight + '&assessment_total=' 
            + total + '&assessment_date=' + date + '&ail_id=' 
            + ail + '&aml_id=' + aml + '&atl_id=' + atl + '&course_id=' + course + '&csv=' + csv
            $http({
                method : 'POST',
                url : url
            }).then(function(response) {
                if (response.data.message === 'success') {
                    // success uploaded show pop up
                    $('#drop-pop').css('color', 'green')
                    $('#drop-pop').css('border-color', 'green')
                    // position in middle
                    if ($('#sidebar').css('margin-left') == '-260px') {
                        var left = $(window).width()/2 - 128
                        $('#drop-pop').css('left', left)
                    }
                    else {
                        var left = $(window).width() - 260
                        left = left/2 + 260 - 128
                        $('#drop-pop').css('left', left)
                    }
                    $('#drop-pop').html('MARKS ARE PUBLISHED')
                    $('#drop-pop').animate({
                        opacity: '1'   
                    }, 100, function() {
                        $('#drop-pop').animate({
                            opacity: '1'   
                        }, 2500, function() {
                            $('#drop-pop').animate({
                                opacity: '0'   
                            }, 250, function() {
                                $('#drop-pop').css('color', '#3472F7')
                                $('#drop-pop').css('border-color', '#3472F7')
                                $('#drop-pop').html('DROP FILE HERE')
                            })
                        })
                    })
                }
                else if (response.data.message === 'error') {
                    // fail show pop up
                    $('#drop-pop').css('color', 'red')
                    $('#drop-pop').css('border-color', 'red')
                    // position in middle
                    if ($('#sidebar').css('margin-left') == '-260px') {
                        var left = $(window).width()/2 - 128
                        $('#drop-pop').css('left', left)
                    }
                    else {
                        var left = $(window).width() - 260
                        left = left/2 + 260 - 128
                        $('#drop-pop').css('left', left)
                    }
                    $('#drop-pop').html('SOMETHING WENT WRONG')
                    $('#drop-pop').animate({
                        opacity: '1'   
                    }, 100, function() {
                        $('#drop-pop').animate({
                            opacity: '1'   
                        }, 2500, function() {
                            $('#drop-pop').animate({
                                opacity: '0'   
                            }, 250, function() {
                                $('#drop-pop').css('color', '#3472F7')
                                $('#drop-pop').css('border-color', '#3472F7')
                                $('#drop-pop').html('DROP FILE HERE')
                            })
                        })
                    })
                }

            }, function() {
                // fail show pop up
                $('#drop-pop').css('color', 'red')
                $('#drop-pop').css('border-color', 'red')
                // position in middle
                if ($('#sidebar').css('margin-left') == '-260px') {
                    var left = $(window).width()/2 - 128
                    $('#drop-pop').css('left', left)
                }
                else {
                    var left = $(window).width() - 260
                    left = left/2 + 260 - 128
                    $('#drop-pop').css('left', left)
                }
                $('#drop-pop').html('SOMETHING WENT WRONG')
                $('#drop-pop').animate({
                    opacity: '1'   
                }, 100, function() {
                    $('#drop-pop').animate({
                        opacity: '1'   
                    }, 2500, function() {
                        $('#drop-pop').animate({
                            opacity: '0'   
                        }, 250, function() {
                            $('#drop-pop').css('color', '#3472F7')
                            $('#drop-pop').css('border-color', '#3472F7')
                            $('#drop-pop').html('DROP FILE HERE')
                        })
                    })
                })
            })
        }

        // add success or danger borders
        if (name.length === 0) {
            $('#assessment-name').removeClass('border-success')
            $('#assessment-name').addClass('border-danger')
        }
        else {
            $('#assessment-name').removeClass('border-danger')
            $('#assessment-name').addClass('border-success')
        }

        // assessment date
        if (date.length === 0) {
            $('#assessment-date').removeClass('border-success')
            $('#assessment-date').addClass('border-danger')
        }
        else {
            $('#assessment-date').removeClass('border-danger')
            $('#assessment-date').addClass('border-success')
        }

        // assessment weight
        if (weight.length === 0) {
            $('#assessment-weight').removeClass('border-success')
            $('#assessment-weight').addClass('border-danger')
        }
        else {
            $('#assessment-weight').removeClass('border-danger')
            $('#assessment-weight').addClass('border-success')
        }

        // assessment total
        if (total.length === 0) {
            $('#assessment-total').removeClass('border-success')
            $('#assessment-total').addClass('border-danger')
        }
        else {
            $('#assessment-total').removeClass('border-danger')
            $('#assessment-total').addClass('border-success')
        }

        // file
        if (csv.length === 0) {
            $('#display-area').removeClass('border-success')
            $('#file-input-label').removeClass('border-success')
            $('#display-area').addClass('border-danger')
            $('#file-input-label').addClass('border-danger')
        }
        else {
            $('#display-area').removeClass('border-danger')
            $('#file-input-label').removeClass('border-danger')
            $('#display-area').addClass('border-success')
            $('#file-input-label').addClass('border-success')
        }

        // assessment info lookup
        if (!(ail > 0)) {
            $('#drop-ail-id').removeClass('border-success')
            $('#drop-ail-id').addClass('border-danger')
        }
        else {
            $('#drop-ail-id').removeClass('border-danger')
            $('#drop-ail-id').addClass('border-success')
        }

        // assessment medium lookup
        if (!(aml > 0)) {
            $('#drop-aml-id').removeClass('border-success')
            $('#drop-aml-id').addClass('border-danger')
        }
        else {
            $('#drop-aml-id').removeClass('border-danger')
            $('#drop-aml-id').addClass('border-success')
        }

        // assessment type lookup
        if (!(atl > 0)) {
            $('#drop-atl-id').removeClass('border-success')
            $('#drop-atl-id').addClass('border-danger')
        }
        else {
            $('#drop-atl-id').removeClass('border-danger')
            $('#drop-atl-id').addClass('border-success')
        }

        // course
        if (!(course > 0)) {
            $('#drop-course-id').removeClass('border-success')
            $('#drop-course-id').addClass('border-danger')
        }
        else {

            $('#drop-course-id').removeClass('border-danger')
            $('#drop-course-id').addClass('border-success')
        }
    }
    $('#assessment-name').focusout(function() {

        // form variables
        var name = $('#assessment-name').val()

        if (name.length === 0) {
            $('#assessment-name').removeClass('border-success')
            $('#assessment-name').addClass('border-danger')
        }
        else {
            $('#assessment-name').removeClass('border-danger')
            $('#assessment-name').addClass('border-success')
        }
    })
    $('#assessment-date').focusout(function() {

        // form variables
        var date = $('#assessment-date').val()

        if (date.length === 0) {
            $('#assessment-date').removeClass('border-success')
            $('#assessment-date').addClass('border-danger')
        }
        else {
            $('#assessment-date').removeClass('border-danger')
            $('#assessment-date').addClass('border-success')
        }
    })
    $('#assessment-weight').focusout(function() {

        var weight = $('#assessment-weight').val()

        if (weight.length === 0 || isNaN(weight)) {
            $('#assessment-weight').removeClass('border-success')
            $('#assessment-weight').addClass('border-danger')
        }
        else {
            $('#assessment-weight').removeClass('border-danger')
            $('#assessment-weight').addClass('border-success')
        }
    })
    $('#assessment-total').focusout(function() {

        var total = $('#assessment-total').val()

        if (total.length === 0 || isNaN(total)) {
            $('#assessment-total').removeClass('border-success')
            $('#assessment-total').addClass('border-danger')
        }
        else {
            $('#assessment-total').removeClass('border-danger')
            $('#assessment-total').addClass('border-success')
        }
    })
//-----------------------------------------------------------------------------
    /**
     * uploading file by browser
     */
    var input = document.getElementById('file-input')

    input.addEventListener('change', function(e) {

        // get files
        var file = input.files[0]

        // display file name
        var name = $('#file-input').val()
        var name = name.split('\\')

        $('#file-input-label').html(name[name.length - 1])

        // read file
        readFile(file)
    })
//-----------------------------------------------------------------------------
    /**
     * dropping files will be done here
     */
    // pop up css for dragging file into window
    $('#drop-pop').attr('style', `
            opacity: 0;
            color: #3472F7;
            font-weight: 900;
            padding: 10px 0px;
            margin: 0px;
            background: transparent;
            display: inline-block;
            width: 256px;
            top: 80px;
            z-index: 10;
            position: absolute;
            border-radius: 4px;
            border-width: 2px;
            border-color: #3472F7;
            border-style: solid;
            box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.3);
            text-align: center;
        `)
    var target = document.getElementById('target')
    // user drags outside of drop area
    target.ondragleave = function(event) {

        // unblur page
        $('#target').css('filter', 'blur(0px)')

        // remove pop up
        $('#drop-pop').css('opacity', '0')
    
        return false;
    }
    // user drags into drop area
    target.ondragover = function(event) {

        // blur page
        $('#target').css('filter', 'blur(1px)')

        // show pop up notification
        if ($('#sidebar').css('margin-left') == '-260px') {
            var left = $(window).width()/2 - 128
            $('#drop-pop').css('left', left)
        }
        else {
            var left = $(window).width() - 260
            left = left/2 + 260 - 128
            $('#drop-pop').css('left', left)
        }
        $('#drop-pop').css('opacity', '1')
    
        return false
    }
    // user drops the file start parsing
    target.ondrop = function(event) {

        $('#target').css('filter', 'blur(0px)')

        // remove pop up
        $('#drop-pop').css('opacity', '0')
    
        event.preventDefault()
    
        // get file
        var file = event.dataTransfer.files[0]
    
        // set name
        $('#file-input-label').html(file.name)
    
        // read file
        readFile(file)
    }
    // read files
    function readFile(file){

        var textType = file.type

        // get display area
        var area = document.getElementById('display-area')


        if (file.type.match(textType)) {

            // create file reader
            var reader = new FileReader()
    
            reader.onload = function(e) {
                // display results
                var upload = reader.result
                displayFile(upload)

                var split = upload.split('\n')
                var length = split.length
                for (i = 0; i < length; i++) {

                    if (split[i].length !== 0) {
                        var column = split[i].split(',')
                        var append = column[0] + ',' + column[1] + ';'
                        csv = csv + append
                    }
                }
            }
            reader.readAsText(file)
        }
        else {
            area.innerText = 'File not supported!'
        }
    }
    // display contents
    function displayFile(upload) {

        var splitted = upload.split('\n')
        var length = splitted.length

        // split rows
        for (i = 1; i < length; i++) {

            // split columns
            var column = splitted[i].split(',')

            // for empty lines
            if (column.length > 1) {
                $('#table-body').append(`
                    <tr>
                        <th scope="row">` + column[0] + `</th>
                        <td>` + column[1] + `</td>
                    </tr>
                `)
            }
        }
    }
    /**
     * end of dragging functions
     */
//-----------------------------------------------------------------------------
})