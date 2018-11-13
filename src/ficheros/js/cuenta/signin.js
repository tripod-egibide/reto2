$("#submit").click((event) =>
  $.post("http://localhost/ficheros/php/cuenta/signin.php", $("#signin").serialize(), (r) => $("#resultado").html(r))
);