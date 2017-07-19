/**
 * @author Fernando López fernando@developerlopez.com
 */

// Navigations posts
Vue.component('navigation', {
    template: '' +
    '<nav role="navigation" class="navigation pagination">' +
        '<h2 class="screen-reader-text">Posts navigation</h2>' +
        '<div class="nav-links">' +
            '<a v-if="currentPage != 1" href="http://localhost/player-theme/page/2/" class="prev page-numbers" v-on:click.prevent="prevPage">' +
                '<i aria-hidden="true" class="fa fa-angle-double-left"></i>' +
            '</a>' +
            '<a v-if="currentPage != maxnumpages" href="http://localhost/player-theme/page/4/" class="next page-numbers" v-on:click.prevent="nextPage">' +
                '<i aria-hidden="true" class="fa fa-angle-double-right"></i>' +
            '</a>' +
        '</div>' +
    '</nav>',
    props: ['paged', 'maxnumpages'],
    data: function () {
        return {
            currentPage: this.paged == 0 ? 1 : this.paged
        }
    },
    methods: {
        prevPage: function () {
            this.currentPage = parseInt(this.currentPage) - 1;
            this.$emit('changepage', this.currentPage);
        },
        nextPage: function () {
            this.currentPage = parseInt(this.currentPage) + 1;
            this.$emit('changepage', this.currentPage);
        }
    }

});

var app = new Vue({
    el: "#player-theme",
    data: {
        ajax: true,
        showTopMenu: window.innerWidth > 576,
        showHomeContent: false,
        actualPage: 1,
        isHomeContent: true,
        rawHtml: '<my-component></my-component>',
        homePosts: []
    },
    mounted: function () {
        this.$nextTick(function() {
            window.addEventListener('resize', this.adjustTopMenu);
        })
    },
    methods: {
        adjustTopMenu: function () {
          return this.showTopMenu = window.innerWidth > 576;
        },
        getHomePosts: function (numberPage) {
            console.log(numberPage);
            var that = this;
            jQuery.ajax({
                url: wp.ajaxUrl,
                method: 'POST',
                dataType: 'json',
                data: {
                    action: 'paginationHome',
                    paged: parseInt(numberPage)
                },
                beforeSend: function (jqXHR) {
                    // Before send
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    // Error handling
                    console.log('Error: ' + textStatus + ' ' + errorThrown);
                    console.log( jqXHR );
                },
                success: function (data, textStatus, jqXHR) {
                    // Change URL
                    window.history.pushState(null, null, wp.siteUrl + '/page/' + numberPage + '/');
                    that.homePosts = data.posts;
                    that.showHomeContent = true;
                    if (jQuery('#noAjax').length) {
                        jQuery('#noAjax').remove();
                    }
                }
            });
        },
        navigationPosts: function (event) {
            console.log(event);
        }
    }
});


