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
    .when('/more-info', {
        templateUrl: 'pages/more-info.html',
        controller: 'MoreInfoController'
    })
    .when('/reportPage', {
    	templateUrl: 'pages/reportPage.php',
        controller: 'reportPageController'
    })
    .otherwise({redirectTo: '/'})
})
.run(function($rootScope, $location, $routeParams, $http) {

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

        /**
         * event listeners
         */
        // logout button
        document.getElementById('logout-button')
        .addEventListener('click', function() {

            $http.post('../api/signing/logout.php')
            .then(function(response) {
                if (response.data.message === 'success') {
                    window.location.href = '../'
                }
            })
        })

        window.onresize = function() {

            // handle card heights and resizing
            var scope = $rootScope.title.toLowerCase()

            // get window height
            var iWinHeight = $(window).height()

            if (scope === 'home') {
                // adjust home page card heights
                var profileCardHeight = 0.5 * (iWinHeight - $('#profile-card').offset().top - 10)
                $('#profile-card').css('height', profileCardHeight)
                var recentCardHeight = 0.5 * (iWinHeight - $('#recent-card').offset().top - 10)
                $('#recent-card').css('height', recentCardHeight)
                var notificationCardHeight = iWinHeight - $('#notification-card').offset().top - 10
                $('#notification-card').css('height', notificationCardHeight)
                var graphCardHeight = iWinHeight - $('#graph-card').offset().top - 10
                $('#graph-card').css('height', graphCardHeight)
            }
            else if (scope === 'grade book') {
                // adjust grade book page card heights
                var stretchGradeBookCard = iWinHeight - $('#grade-book-card').offset().top - 10
                $('#grade-book-card').css('height', stretchGradeBookCard)
            }
            else if (scope === 'statistics') {
                // adjust statistics page card heights
                var stretchTopCards = 0.5 * (iWinHeight - $('.stretch-card-top').offset().top - 10)
                $('.stretch-card-top').css('height', stretchTopCards)
                var stretchBottomCards = iWinHeight - $('.stretch-card-bottom').offset().top - 10
                $('.stretch-card-bottom').css('height', stretchBottomCards)
            }
            else if (scope === 'upload marks') {
                // adjust upload marks page card heights
                var wheight = $(window).height() - $('#config-card').offset().top - 10;
                var warea = $(window).height() - $('#display-area').offset().top - 20;
                $('#config-card').css('height', wheight)
                $('#display-area').css('height', warea)
            }
            else if (scope === 'student statistics') {
                // adjust statistics page card heights
                var stretchTopCards = 0.5 * (iWinHeight - $('.stretch-card-top').offset().top - 10)
                $('.stretch-card-top').css('height', stretchTopCards)
                var stretchBottomCards = iWinHeight - $('.stretch-card-bottom').offset().top - 10
                $('.stretch-card-bottom').css('height', stretchBottomCards)
            }
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
.controller('HomeController', function($scope, $http, $rootScope) {

    /**
     * set up user interface
     */
    $scope.title = 'Home'
    $rootScope.title = 'Home'

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
//-----------------------------------------------------------------------------

    /**
     * get data base data
     */
    // get variables from database
    $http.post('../api/signing/signed.php')
    .then(function(response) {

        if (response.data.message === 'success') {

            $('#profile-name').html('Welcome, ' + response.data.contents.user_name)

            // get summary
            $http.get('../api/basic/summary.php?user_id=' + response.data.contents.user_id)
            .then(function(responses) {
                // sets up results card
                $scope.assessments = responses.data.contents.assessments
                // heading
                var heading = responses.data.contents.assessments[0].assessment_name
                var aTotal = responses.data.contents.assessments[0].assessment_total
                aTotal = aTotal.split('.') // in case of decimal number from database
                $('#recent-heading').html('Recent : ' + heading + ' out of ' + aTotal[0])
                // set date
                var d = responses.data.contents.assessments[0].assessment_date.split('-')
                var date = new Date(d[0], d[1], d[2])
                d = date.toDateString()
                date = d.substr(0, d.length - 5)
                $('#recent-date').html('<i class="fa fa-table"></i> ' + date)

                // learn more here : 
                // https://medium.com/@heyoka/scratch-made-svg-donut-pie-charts-in-html5-2c587e935d72
                
                // donut chart core elements
                var svg
                var text
                var svgTag = '<svg width="95%" height="95%" viewBox="0 0 42 42" class="donut">'
                // donut hole gives illusion of hole without it it looks like pie chart
                var donutHole = '<circle class="donut-hole" cx="21" cy="21" r="15.91549430918954" fill="#fff"></circle>'
                var donutRing = '<circle class="donut-ring" cx="21" cy="21" r="15.91549430918954"' + 
                'fill="transparent" stroke="#d2d3d4" stroke-width="3"></circle>'

                // set up average graph
                // color must change according to average
                var ave = responses.data.contents.assessments[0].average / responses.data.contents.assessments[0].assessment_total * 100
                ave = parseInt(ave)
                var colour
                // now colour
                if (ave >= 75) {
                    // cum laude dark green
                    colour = '#338000c4'
                }
                else if (ave >= 50 && ave < 75) {
                    //  average mark yellowish green
                    colour = '#aad400c4'
                }
                else if (ave >= 35 && ave < 50) {
                    // danger zone orange
                    colour = '#ff7f2ac4'
                }
                else {
                    // fail zone
                    colour = '#800000c4'
                }
                var status = '<i class="fa fa-circle" style="margin-right:10px;color:' + colour + '"></i>'
                $('#recent-date').html(status + ' ' + '<i class="fa fa-table"></i> ' + date)
                var dash = 100 - ave
                var averageStroke = ave + ' ' + dash
                ave = responses.data.contents.assessments[0].average

                // show one decimal point
                ave = ave + ''
                var deci = ave.split('.')

                if (deci.length === 1) {
                    ave = deci[0]
                }
                else {
                    ave = deci[0] + '.' + deci[1].substr(0, 1)
                }

                var donutSegment = '<circle class="donut-segment" cx="21" cy="21" r="15.91549430918954" fill="transparent"' +
                'stroke="' + colour + '" stroke-width="3" stroke-dasharray="' + averageStroke + '" stroke-dashoffset="10"></circle>'
                text = '<g class="chart-text"><text x="50%" y="50%" class="chart-number">' + 
                ave + '</text><text x="50%" y="50%" class="chart-label">average</text></g>'
                svg = svgTag + donutHole + donutRing + donutSegment + text + '</svg>'
                $('#graph-average').html(svg)

                // set up pass fail graph
                var pass = responses.data.contents.assessments[0].pass
                var fail = responses.data.contents.assessments[0].fail
                var total = responses.data.contents.assessments[0].pass + responses.data.contents.assessments[0].fail
                var passRate = responses.data.contents.assessments[0].pass / total * 100 + ''
                passRate = parseInt(passRate)
                var failRate = 100 - passRate

                var donutSegmentPass = '<circle class="donut-segment" cx="21" cy="21" r="15.91549430918954" fill="transparent"' +
                'stroke="#217867c4" stroke-width="3"' + 
                'stroke-dasharray="' + passRate + ' ' + failRate + '"' + 'stroke-dashoffset="80"></circle>'
                var strokeDashOffset = 100 - passRate + 80
                var donutSegmentFail = '<circle class="donut-segment" cx="21" cy="21" r="15.91549430918954" fill="transparent"' +
                'stroke="#c83737c4" stroke-width="3"' + 
                'stroke-dasharray="' + failRate + ' ' + passRate + '"' + 'stroke-dashoffset="' + strokeDashOffset + '"></circle>'
                text = '<g class="chart-text"><text x="50%" y="50%" class="chart-number">' + 
                pass + '/' + fail + '</text><text x="50%" y="50%" class="chart-label">pass-fail</text></g>'
                svg = svgTag + donutHole + donutRing + donutSegmentPass + donutSegmentFail + text + '</svg>'
                $('#graph-passfail').html(svg)

                // set up risk graph
                text = '<g class="chart-text"><text x="50%" y="50%" class="chart-number">' + 
                'no</text><text x="50%" y="50%" class="chart-label">risk data</text></g>'
                svg = svgTag + donutHole + donutRing + text + '</svg>'
                $('#graph-risk').html(svg)
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
.controller('GradeBookController', function($scope, $http, $rootScope) {

    // nav title
    $scope.title = 'Grade Book'
    $rootScope.title = 'Grade Book'
    
    /**
     * events
     */
    // toggle sidebar on click
    $scope.sidebar = function() {
        $('#sidebar').toggleClass('active')
    }

    // table row clicked
    $scope.table = function(events) {
        // clicked on row and not on button column
        if (events.target.cellIndex < 5) {
            // get student number
            var id = events.target.parentNode.children[0].innerHTML

            // go to more info page with student number
            window.location.href = './#!/more-info?student=' + id
        }
    }

    $scope.popup = function(events) {

        // get row
        var number = events.target.parentNode.parentNode.children[0].innerHTML

        if (isNaN(number)) {
            var student = events.target.parentNode.parentNode.parentNode.children[0].innerHTML
            $('#span-student').html(student)
            var name = events.target.parentNode.parentNode.parentNode.children[1].innerHTML
            var surname = events.target.parentNode.parentNode.parentNode.children[2].innerHTML
            $('#span-name').html(name + ' ' + surname)
        }
        else {
            var student = events.target.parentNode.parentNode.children[0].innerHTML
            $('#span-student').html(student)
            var name = events.target.parentNode.parentNode.children[1].innerHTML
            var surname = events.target.parentNode.parentNode.children[2].innerHTML
            $('#span-name').html(name + ' ' + surname)
        }
        // make visible inline-block
        if ($('#sidebar').css('margin-left') === '-260px') {
            // width 192
            var width = ($(window).width())/2 - 192
            $('.pop-up-thing').css('left', width + 'px')
        }
        else {

            var width = ($(window).width() - 260)/2 + 260 - 192
            $('.pop-up-thing').css('left', width + 'px')
        }
        $('.pop-up-thing').css('display', 'inline-block')
    }
    $scope.close = function() {
        $('.pop-up-thing').css('display', 'none')
    }

    /**
     * set up initial user interface
     */
    // init variables - change on resize
    var iWinHeight = $(window).height()

    // stretch top card
    var stretchGradeBookCard = iWinHeight - $('#grade-book-card').offset().top - 10
    $('#grade-book-card').css('height', stretchGradeBookCard)
//-----------------------------------------------------------------------------
    // get variables from database
    $http.post('../api/signing/signed.php')
    .then(function(response) {

        if (response.data.message === 'success') {

            // get user id
            var userId = response.data.contents.user_id
            $scope.user = response.data.contents.user_id

            // get records for table
            $http.post('../api/marks/grades.php?user_id=' + userId)
            .then(function(responses) {

                if (responses.data.message === 'success') {

                    // set up drop downs
                    var courses = responses.data.contents.courses

                    // options
                    var options = ''

                    for (i = 0; i < courses.length; i++) {

                        if (i === 0) {
                            // option
                            options += '<option selected value="' + courses[i]['course_id'] + '">'
                            options += courses[0]['course_name']
                            options += '</option>'
                        }
                        else {
                            // option
                            options += '<option value="' + courses[i]['course_id'] + '">'
                            options += courses[i]['course_name']
                            options += '</option>'
                        }
                    }
                    $('#course-drop-down').html(options)

                    // set scopes for table
                    $scope.grades = responses.data.contents.grades
                    $scope.enrolled = responses.data.contents.grades.length
                }
                else {
                    // something went wrong
                }
            })

        }
        else {
            window.location.href = '../'
        }
    })

    $('#course-drop-down').on('change', function() {
        // values
        var id = $scope.user
        var course = $('#course-drop-down').val()
        var year = $('#year-drop-down').val()

        // get records for table
        var url = '../api/marks/grades.php?user_id=' + id + '&course_id=' + course + '&year=' + year
        $http.post(url)
        .then(function(responses) {

            if (responses.data.message === 'success') {

                // set scopes for table
                $scope.grades = responses.data.contents.grades
                $scope.enrolled = responses.data.contents.grades.length
            }
            else {
                // something went wrong
            }
        })
    })

    $('#year-drop-down').on('change', function() {
        // values
        var id = $scope.user
        var course = $('#course-drop-down').val()
        var year = $('#year-drop-down').val()

        // get records for table
        var url = '../api/marks/grades.php?user_id=' + id + '&course_id=' + course + '&year=' + year
        $http.post(url)
        .then(function(responses) {

            if (responses.data.message === 'success') {

                // set scopes for table
                $scope.grades = responses.data.contents.grades
                $scope.enrolled = responses.data.contents.grades.length
            }
            else {
                // something went wrong
            }
        })
    })
})

/**
 * statistics view
 */
.controller('StatisticsController', function($scope, $http, $rootScope) {

    /**
     * set up user interface
     */
    $scope.title = 'Lecturer'
    $rootScope.title = 'Lecturer'

    $scope.student='Lecturer Info'
    $rootScope.student= 'Statistics'

    $scope.courses='Courses Taught'
    $rootScope.courses= 'Statistics'

    $scope.average='Course Average'
    $rootScope.average = 'Statistics'


    $scope.average1='Course Average'
    $rootScope.average = 'Statistics'

    $scope.average2='Course Average'
    $rootScope.average = 'Statistics'

    $scope.average3='Course Average'
    $rootScope.average = 'Statistics'


    $scope.average4='Course Average'
    $rootScope.average = 'Statistics'

    $scope.staff_id=''
    $rootScope.staff_id = ''

    $('#courses').hide()
    $('#plot1').hide()
    $('#plot2').hide()
    $('#plot3').hide()
    $('#plot4').hide()
    /*
    $scope.risk='Students Risk'
    $rootScope.risk ='Statistics'
    */
    // toggle sidebar on click
    $scope.sidebar = function() {
        $('#sidebar').toggleClass('active')
    }

    $scope.refresh = function() {
        console.log('clicked')
    }

    // init variables - change on resize
    var iWinHeight = $(window).height()

    // stretch top cards
    var stretchTopCards = 0.5 * (iWinHeight - $('.stretch-card-top').offset().top - 10)
    $('.stretch-card-top').css('height', stretchTopCards)
    // stretch bottom cards
    var stretchBottomCards = iWinHeight - $('.stretch-card-bottom').offset().top - 10
    $('.stretch-card-bottom').css('height', stretchBottomCards)
//-----------------------------------------------------------------------------
    // get variables from database
    var user
    $http.post('../api/signing/signed.php')
    .then(function(response) {
        if (response.data.message === 'success') {
            // get subjects
            user=response.data.contents.user_id
            console.log(user)

            $http.get('../api/stats/get.php?lecturer='+user+'&type=average').then(function(res){
                console.log(res.data)
                res.data.forEach(function(element,index){

                    if(index==0)
                    {
                        $('#plot1').show()
                        var avg=parseInt(element.average)
                        not_average=100-avg
                        $('#course1').html(element.course_name+` (`+avg+`% average)`)

                        var data = {
                          series: [avg,100-avg]
                        };

                        var sum = function(a, b) { return a + b };

                        
                        new Chartist.Pie('#figure1', data, {
                          labelInterpolationFnc: function(value) {
                            return Math.round(value / data.series.reduce(sum) * 100) + '%';
                          }
                        });
                    }

                    if(index==1)
                    {
                        $('#plot2').show()
                        var avg=parseInt(element.average)
                        not_average=100-avg
                        $('#course2').html(element.course_name+` (`+avg+`% average)`)
                        var data = {
                          series: [avg,100-avg]
                        };

                        var sum = function(a, b) { return a + b };

                        
                        new Chartist.Pie('#figure2', data, {
                          labelInterpolationFnc: function(value) {
                            return Math.round(value / data.series.reduce(sum) * 100) + '%';
                          }
                        });
                    }

                    if(index==2)
                    {
                        $('#plot3').show()
                        var avg=parseInt(element.average)
                        not_average=100-avg
                        $('#course3').html(element.course_name+` (`+avg+`% average)`)
                        var data = {
                          series: [avg,100-avg]
                        };

                        var sum = function(a, b) { return a + b };

                        
                        new Chartist.Pie('#figure3', data, {
                          labelInterpolationFnc: function(value) {
                            return Math.round(value / data.series.reduce(sum) * 100) + '%';
                          }
                        });
                    }

                    if(index==3)
                    {
                        $('#plot4').show()
                        var avg=parseInt(element.average)
                        not_average=100-avg
                        $('#course4').html(element.course_name+` (`+avg+`% average)`)
                        var data = {
                          series: [avg,100-avg]
                        };

                        var sum = function(a, b) { return a + b };

                        
                        new Chartist.Pie('#figure4', data, {
                          labelInterpolationFnc: function(value) {
                            return Math.round(value / data.series.reduce(sum) * 100) + '%';
                          }
                        });
                    }
                })
                                
            })

            $http.get('../api/stats/get.php?lecturer='+user+'&type=info').then(function(res){
                    $scope.staff_id =res.data.user_id 
                    $rootScope.staff_id =res.data.user_id 

                    $scope.name =res.data.user_name 
                    $rootScope.name =res.data.user_name

                    $scope.surname =res.data.user_surname 
                    $rootScope.surname =res.data.user_surname

                    $scope.faculty =res.data.faculty_name 
                    $rootScope.faculty =res.data.faculty_name
            })
            console.log('user is signed in')
        }
        else {
            window.location.href = '../'
        }
    })
})

/**
 * upload marks view
 */
.controller('UploadMarksController', function($scope, $http, $timeout, $rootScope) {

    /**
     * set up user interface
     */
    $scope.title = 'Upload Marks'
    $rootScope.title = 'Upload Marks'
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

/**
 * more info on student
 */
.controller('MoreInfoController', function($scope, $http, $rootScope) {

    /**
     * set up view
     */
    $scope.title = 'Student Statistics'
    $rootScope.title = 'Student Statistics'

    $scope.student='Student Info'
    $rootScope.student= 'Statistics'

    $scope.courses='Students Courses'
    $rootScope.courses= 'Statistics'

    $scope.average='Students Average'
    $rootScope.average = 'Statistics'

    $scope.risk='Students Risk'
    $rootScope.risk ='Statistics'
    // get variables from database
    student=""
    $http.post('../api/signing/signed.php')
    .then(function(response) {
        if (response.data.message === 'success') {

            // student number
            var url = window.location.href.split('=')
            // use to get database reques
            student = url[1]
            //console.log(student)
            $http.get('../api/more_info/data.php?student=student&student_nr='+student).then(function(res){
                //console.log(res.data)
                $('#student_info').html(`<p>
                                            <center>Student Number:`+res.data.user_id+`</center>
                                        </p>
                                        <p>
                                            <center>Name:`+res.data.user_name+`</center>
                                        </p>
                                        <p>
                                            <center>Surname:`+res.data.user_surname+`</center>
                                        </p>
                                    `)
            })
            $http.get('../api/more_info/data.php?courses=courses&student_nr='+student).then(function(res){
                var course_names=[]
                var marks=[]
                res.data.forEach(function(element){
                    course_names.push(element.course)
                    marks.push(parseInt(element.mark_total))
                })
                //course_names.push('')
                //marks.push(100)
                new Chartist.Bar('#student_courses', {
                  labels: course_names,
                  series: marks
                }, {
                  distributeSeries: true
                });

                for(i=0;i<marks.length;i++)
                {
                    if(marks>=50)
                    {
                        $('#course_list').html(`<li class="list-group-item" style="color:green;font-weight: 300;">`+course_names[i]+` (`+marks[i]+`%)</li>`)
                    }
                    else
                    {
                        $('#course_list').html(`<li class="list-group-item" style="color:red;font-weight: 300;">`+course_names[i]+` (`+marks[i]+`%)</li>`)
                    }    
                }

            })
            $http.get('../api/more_info/data.php?average=average&student_nr='+student).then(function(res){
                var avg=parseInt(res.data[0].average)
                not_average=100-avg
                $scope.average+=' ('+avg+'%)'
                var data = {
                  series: [avg,100-avg]
                };

                var sum = function(a, b) { return a + b };

                new Chartist.Pie('#student_average', data, {
                  labelInterpolationFnc: function(value) {
                    return Math.round(value / data.series.reduce(sum) * 100) + '%';
                  }
                });
            })
        }
        else {
            window.location.href = '../'
        }
    })
    // card heights
    var iWinHeight = $(window).height()
    //console.log(student)
    // stretch top cards
    var stretchTopCards = 0.5 * (iWinHeight - $('.stretch-card-top').offset().top - 10)
    $('.stretch-card-top').css('height', stretchTopCards)
    // stretch bottom cards
    var stretchBottomCards = iWinHeight - $('.stretch-card-bottom').offset().top - 10
    $('.stretch-card-bottom').css('height', stretchBottomCards)
//-----------------------------------------------------------------------------
    /**
     * events
     */
    $scope.back = function() {
        window.location.href = './#!/grade-book'
    }
})
.controller('reportPageController', function($scope, $http, $rootScope) {
	$scope.title = 'Student Statistics'
    $rootScope.title = 'Student Statistics'
    console.log('ghvjh')


})
