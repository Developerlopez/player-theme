/**
 * @author Fernando López fernando@developerlopez.com
 */
var app = new Vue({
    el: "#player-theme",
    data: {
        showTopMenu: window.innerWidth > 576
    },
    mounted: function () {
        this.$nextTick(function() {
            window.addEventListener('resize', this.adjustTopMenu);
        })

    },
    methods: {
        adjustTopMenu: function () {
          return this.showTopMenu = window.innerWidth > 576;
        }
    }
});


