$("#submit").click((event) =>
  $.post(".../php/cuenta/signin.php", $("#signin").serialize())
)