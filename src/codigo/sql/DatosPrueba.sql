/*USUARIOS*/
INSERT INTO `usuario` (`idusuario`, `usuario`, `email`, `contrasenna`, `descripcion`, `url_avatar`)
	VALUES (NULL, 'user1', 'user1@email.com', 'user1', 'desc user1', '/imagenes/avatar/1.jpg');
INSERT INTO `usuario` (`idusuario`, `usuario`, `email`, `contrasenna`, `descripcion`, `url_avatar`)
	VALUES (NULL, 'user2', 'user2@email.com', 'user2', 'desc user2', '/imagenes/avatar/2.jpg');
/*PREGUNTAS*/
INSERT INTO `pregunta` (`idpregunta`, `idusuario`, `titulo`, `texto`, `fecha_creacion`)
	VALUES (NULL, '1', 'Pregunta 1 User1', 'texto', CURRENT_TIMESTAMP);
INSERT INTO `pregunta` (`idpregunta`, `idusuario`, `titulo`, `texto`, `fecha_creacion`)
	VALUES (NULL, '1', 'Pregunta 2 User1', 'texto', CURRENT_TIMESTAMP);
INSERT INTO `pregunta` (`idpregunta`, `idusuario`, `titulo`, `texto`, `fecha_creacion`)
	VALUES (NULL, '2', 'Ayuda!', 'nececito ayuda!!', CURRENT_TIMESTAMP);
INSERT INTO `pregunta` (`idpregunta`, `idusuario`, `titulo`, `texto`, `fecha_creacion`)
	VALUES (NULL, '2', 'Pregunta 2 User2', 'texto', CURRENT_TIMESTAMP);
/*RESPUESTAS*/
INSERT INTO `respuesta` (`idrespuesta`, `idpregunta`, `idusuario`, DEFAULT, ``, `resuelve`, `fecha_creacion`)
	VALUES (NULL, '1', '2', 'Respuesta User2, pregunta 1 User1', 'texto', '0', CURRENT_TIMESTAMP);
INSERT INTO `respuesta` (`idrespuesta`, `idpregunta`, `idusuario`, `No`, `nooooooooooooo`, `resuelve`, `fecha_creacion`)
	VALUES (NULL, '3', '1', 'Respuesta User1, pregunta 1 User2', 'texto', '1', CURRENT_TIMESTAMP);
/*ETIQUETAS*/
INSERT INTO `etiqueta` (`idetiqueta`, `etiqueta`) VALUES (NULL, 'HTML');
INSERT INTO `etiqueta` (`idetiqueta`, `etiqueta`) VALUES (NULL, 'JavaScript');
INSERT INTO `etiqueta` (`idetiqueta`, `etiqueta`) VALUES (NULL, 'PHP');
/*pregunta_tiene_etiquetaS*/
INSERT INTO `pregunta_tiene_etiqueta` (`idetiqueta`, `idpregunta`) VALUES (1, 1);
INSERT INTO `pregunta_tiene_etiqueta` (`idetiqueta`, `idpregunta`) VALUES (3, 1);
INSERT INTO `pregunta_tiene_etiqueta` (`idetiqueta`, `idpregunta`) VALUES (2, 2);
/*VOTOS PREGUNTAS*/
INSERT INTO `voto_pregunta` (`idusuario`, `idpregunta`, `positivo`)
	VALUES (1, 3, 1);
INSERT INTO `voto_pregunta` (`idusuario`, `idpregunta`, `positivo`)
	VALUES (2, 1, 0);
/*VOTOS RESPUESTAS*/
INSERT INTO `voto_respuesta` (`idusuario`, `idrespuesta`, `positivo`)
	VALUES (2, 2, 1);
INSERT INTO `voto_respuesta` (`idusuario`, `idrespuesta`, `positivo`)
	VALUES (1, 1, 0);
