CREATE TABLE post (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  titulo varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  contenido longtext COLLATE utf8_unicode_ci NOT NULL,
  created_at datetime NOT NULL,
  updated_at datetime,
  PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE comentario (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  id_post bigint(20) NOT NULL,
  autor varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  contenido longtext COLLATE utf8_unicode_ci NOT NULL,
  creado_at datetime NOT NULL,
  updated_at datetime,
  PRIMARY KEY (id),
  KEY comentario_id_post_idx (id_post),
  CONSTRAINT id_post FOREIGN KEY (id_post) REFERENCES post (id) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;