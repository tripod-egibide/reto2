
$("#signin").submit((event) => {
  let status;
  $.post(window.root + "/ficheros/php/cuenta/signin.php", $("#signin").serialize(), ((r) => {
    $("#resultado").html(r)
    status = r;
  }));
  if (status) {
    header()
  } else {
    $(".contra").val("");
    return false;
  }
});

