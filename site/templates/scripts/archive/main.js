// Snippets
var FirstCurtainMenu = {
  $el: $('.js-nav'),
  $elToggle: $('.js-nav-toggle'),
  $elSecondCurtain: $('.js-second-nav'),
  $elChildren: $('.nav__item__wrapper'),
  isOpened: false,
  
  events: function() {
    var self = this;
    this.$elToggle.on('click', function() {
      if (self.isOpened) {
        self.close();
      } else {
        self.open();
      }
    });
    $(document).on('click', function(e) {
      if (self.isOpened) {
        var is_menu = $(e.target).closest(self.$el).length;
        var is_toggle = $(e.target).closest(self.$elToggle).length;
        var is_secondCurtain = $(e.target).closest(self.$elSecondCurtain).length;
        if(!is_menu && !is_toggle && !is_secondCurtain) {
          self.close();
        }
      }
    });
  },
  open: function() {
    this.$el.addClass('is-open');
    this.$elToggle.addClass('is-active');
    this.isOpened = true;
  },
  close: function() {
    this.$el.removeClass('is-open');
    this.$elToggle.removeClass('is-active');
    this.$elChildren.removeClass('is-selected');
    this.isOpened = false;
  },
  init: function() {
  this.events();
  }
};

    var SecondCurtainMenu = {
      $el: $('.js-second-nav'),
      $elToggle: $('.nav__item__wrapper'),
      isOpened: false,
      
      events: function() {
        var self = this;
        this.$elToggle.on('click', function(e) {
          if (self.isOpened) {
            self.updateContent(e);
          } else {
            self.open(e);
            self.updateContent(e);
          }
        });
        // Close both curtains when user clicks on the header toggle
        $('.js-nav-toggle').on('click', function() {
          if (self.isOpened) {
            self.close();
            self.isOpened = false;
          }
        });
      },
      open: function(e) {
        this.$el.addClass('is-open');
        $(e.target).addClass('is-selected');
        this.isOpened = true;
      },
      close: function() {
        this.$el.removeClass('is-open');
        this.isOpened = false;
      },
      updateContent: function(e) {
        this.$elToggle.removeClass('is-selected');
        $(e.target).addClass('is-selected');
        $('.nav--right__content__child-name').text($(e.target).text());
      },
      init: function() {
      this.events();
      }
    };

    var SearchBar = {
      $el: $('.js-nav-search'),
      $elToggleOpen: $('.js-nav-search-open'),
      $elToggleClose: $('.js-nav-search-close'),
      isOpened: false,
      
      events: function() {
        var self = this;
        this.$elToggleOpen.on('click', function() {
          if (!self.isOpened) { self.open(); }
        });
        this.$elToggleClose.on('click', function() {
          if (self.isOpened) { self.close(); }
        });
      },
      open: function() {
        this.$el.addClass('is-active');
        this.isOpened = true;
      },
      close: function() {
        this.$el.removeClass('is-active');
        this.isOpened = false;
      },
      init: function() {
      this.events();
      }
    };

    FirstCurtainMenu.init();
    SecondCurtainMenu.init();
    SearchBar.init();