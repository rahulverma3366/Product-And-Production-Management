<?php
if ( !empty( $_SESSION[ 'errormsg' ] ) ) {
  $errormsg = $_SESSION[ 'errormsg' ];
  $errorValue = $_SESSION[ 'errorValue' ];
  ?>

<script type="text/javascript">
$.toast({
    heading: '<?=$errorValue?>',
    text: '<?=$errormsg;?>',
      icon: '<?=$errorValue?>',
    position: 'top-right',
    stack: false
})

</script>

  <?php
  unset( $_SESSION[ 'errormsg' ] );
  unset( $_SESSION[ 'errorValue' ] );
} else {
  unset( $_SESSION[ 'errormsg' ] );
  unset( $_SESSION[ 'errorValue' ] );
}
?>