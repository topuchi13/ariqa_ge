if ( _.isUndefined( window.vc ) ) {
  var vc = { atts: {} };
}
(function ( $ ) {
  var TMResponsiveParam =  Backbone.View.extend( {
    events: {
    },
    initialize: function () {
    },
    render: function () {
      return this;
    },
    save: function () {
      var data = [];
      this.$el.find( '.thememove_responsive_field' ).each( function () {
        var $field = $( this );
        if ( $field.is( ':checkbox:checked' ) ) {
          data.push( $field.attr( 'name' ) );
        } else if ( $field.is( 'select' ) && $field.val() != '' ) {
          data.push( $field.val() );
        }
      } );
      return data;
    }
  } );
  vc.atts.thememove_responsive = {
    parse: function ( param ) {
      var $field = this.content().find( 'input.wpb_vc_param_value.' + param.param_name + '' ),
        thememove_responsive = $field.data( 'tmResponsiveParam' ),
        result = thememove_responsive.save();
      return result.join( ' ' );
    },
    init: function ( param, $field ) {
      $( '[data-responsive="true"]', $field ).each( function () {
        var $this = $( this ),
          $field = $this.find( '.wpb_vc_param_value' );
        $field.data( 'tmResponsiveParam', new TMResponsiveParam( { el: $this } ).render() );
      } );
    }
  };
})( window.jQuery );