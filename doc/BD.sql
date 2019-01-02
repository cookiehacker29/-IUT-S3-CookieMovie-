create table GENRE(
  idg               Decimal(6) NOT NULL,
  nomGenre          Varchar(20) NOT NULL,
  constraint GENRE primary key(idg)
);


CREATE TABLE UTILISATEUR(
    idUt            Decimal (6) NOT NULL,
    pseudoUt        Varchar (20) NOT NULL,
    mdpUt           Varchar (200) NOT NULL,
    emailUt         Varchar (200) NOT NULL,
	constraint UTILISATEUR_PK primary key (idUt)
);

create table FILM(
  idFilm            Decimal(6) NOT NULL,
  titreFilm         Varchar(20) NOT NULL,
  imageFilm         Varchar(500),
  resumerFilm       Text,
  anneeRealisation  int(4),
  nomRea            Varchar(20),
  prenomRea         Varchar(20),
  idg               Decimal(6),
  idUt              Decimal(6),
  constraint FILM primary key(idFilm),
  constraint clefEtrangereFilmGenre foreign key (idg) references GENRE(idg),
  constraint clefEtrangereUtilisateurFilm foreign key (idUt) references UTILISATEUR(idUt)
);


-- UTILISATEUR --
insert into UTILISATEUR values(1, 'CookieHacker', 'cookiedu45', 'cookie@gmail.com');

-- GENRE --
insert into GENRE values(1, 'Action');
insert into GENRE values(2, 'Animation');
insert into GENRE values(3, 'Aventure');
insert into GENRE values(4, 'Comédie');
insert into GENRE values(5, 'Epouvante');
insert into GENRE values(6, 'Catastrophe');
insert into GENRE values(7, 'Guerre');
insert into GENRE values(8, 'Horreur');
insert into GENRE values(9, 'Thriller');
insert into GENRE values(10, 'Science Fiction');

-- FILM --
insert into FILM values(1, 'The Terminator 1', 'https://i2.wp.com/www.kickassfacts.com/wp-content/uploads/2016/05/Arnold-Schwarzenegger-1.jpg', "A Los Angeles en 1984, un Terminator, cyborg surgi du futur, a pour mission d'exécuter Sarah Connor, une jeune femme dont l'enfant à naître doit sauver l'humanité. Kyle Reese, un résistant humain, débarque lui aussi pour combattre le robot, et aider la jeune femme...", 1984,'James', 'Cameron', 10, 1);
insert into FILM values(2, 'John Wick 2', 'http://origin.johnwick.movie/assets/img/gallery/pos03.jpg', 'John Wick est forcé de sortir de sa retraite volontaire par un de ses ex-associés qui cherche à prendre le contrôle d’une mystérieuse confrérie de tueurs internationaux. Parce qu’il est lié à cet homme par un serment, John se rend à Rome, où il va devoir affronter certains des tueurs les plus dangereux du monde. ', 2017,'Chad', 'Stahelski', 1 ,1);
insert into FILM values(3, 'Your Name', 'http://fr.web.img2.acsta.net/r_1920_1080/pictures/16/12/12/13/49/295774.jpg', 'Mitsuha, adolescente coincée dans une famille traditionnelle, rêve de quitter ses montagnes natales pour découvrir la vie trépidante de Tokyo. Elle est loin d’imaginer pouvoir vivre l’aventure urbaine dans la peau de… Taki, un jeune lycéen vivant à Tokyo, occupé entre son petit boulot dans un restaurant italien et ses nombreux amis. À travers ses rêves, Mitsuha se voit littéralement propulsée dans la vie du jeune garçon au point qu’elle croit vivre la réalité... Tout bascule lorsqu’elle réalise que Taki rêve également d’une vie dans les montagnes, entouré d’une famille traditionnelle… dans la peau d’une jeune fille ! Une étrange relation s’installe entre leurs deux corps qu’ils accaparent mutuellement. Quel mystère se cache derrière ces rêves étranges qui unissent deux destinées que tout oppose et qui ne se sont jamais rencontrées ?', 2016,'Makoto', 'Shinkai', 2, 1);
insert into FILM values(4, 'Kong: Skull Island', 'http://fr.web.img4.acsta.net/r_1920_1080/pictures/17/02/24/14/49/440855.jpg', "Un groupe d'explorateurs plus différents les uns que les autres s'aventurent au cœur d'une île inconnue du Pacifique, aussi belle que dangereuse. Ils ne savent pas encore qu'ils viennent de pénétrer sur le territoire de Kong…", 2017,'Jordan', "Vogt-Roberts", 3, 1);
insert into FILM values(5, 'Knock', 'http://fr.web.img5.acsta.net/r_1920_1080/pictures/17/08/17/11/25/342106.jpg', "Knock, un ex-filou repenti devenu médecin diplômé, arrive dans le petit village de Saint-Maurice pour appliquer une méthode destinée à faire sa fortune : il va convaincre la population que tout bien portant est un malade qui s'ignore. Et pour cela, trouver à chacun la maladie réelle ou imaginaire dont il souffre. Passé maitre dans l'art de la séduction et de la manipulation, Knock est sur le point de parvenir à ses fins. Mais il est rattrapé par deux choses qu'il n'avait pas prévues : les sentiments du coeur et un sombre individu issu de son passé venu le faire chanter.", 2017,'Lorraine', 'Lévy', 4, 1);
insert into FILM values(6, 'Shining', 'http://fr.web.img2.acsta.net/r_1920_1080/pictures/17/09/21/17/20/1362538.jpg', "Jack Torrance, gardien d'un hôtel fermé l'hiver, sa femme et son fils Danny s'apprêtent à vivre de longs mois de solitude. Danny, qui possède un don de médium, le Shining, est effrayé à l'idée d'habiter ce lieu, théâtre marqué par de terribles évènements passés... ", 1980,'Stanley', 'Kubrick', 5, 1);
insert into FILM values(7, 'Full Metal Jacket', 'http://fr.web.img5.acsta.net/r_1920_1080/medias/nmedia/18/65/57/12/19254508.jpg', "Pendant la guerre du Vietnam, la préparation et l'entrainement d'un groupe de jeunes marines, jusqu'au terrible baptême du feu et la sanglante offensive du Tet a Hue, en 1968. ", 1987,'Brad', 'Peyton', 6, 1);
insert into FILM values(8, 'San Andreas', 'http://fr.web.img2.acsta.net/r_1920_1080/pictures/15/04/23/15/38/341525.jpg', "Lorsque la tristement célèbre Faille de San Andreas finit par s'ouvrir, et par provoquer un séisme de magnitude 9 en Californie, un pilote d'hélicoptère de secours en montagne et la femme dont il s'est séparé quittent Los Angeles pour San Francisco dans l'espoir de sauver leur fille unique. Alors qu'ils s'engagent dans ce dangereux périple vers le nord de l'État, pensant que le pire est bientôt derrière eux, ils ne tardent pas à comprendre que la réalité est bien plus effroyable encore… ", 2016,'James', 'Wan', 7, 1);
insert into FILM values(9, 'Conjuring : Les dossiers Warren', 'http://fr.web.img6.acsta.net/r_1920_1080/pictures/210/025/21002526_20130430172022533.jpg', "Avant Amityville, il y avait Harrisville… Conjuring : Les dossiers Warren, raconte l'histoire horrible, mais vraie, d'Ed et Lorraine Warren, enquêteurs paranormaux réputés dans le monde entier, venus en aide à une famille terrorisée par une présence inquiétante dans leur ferme isolée… Contraints d'affronter une créature démoniaque d'une force redoutable, les Warren se retrouvent face à l'affaire la plus terrifiante de leur carrière…", 2013,'David', 'Cronenberg', 8, 1);
insert into FILM values(10, 'A History of Violence', 'http://fr.web.img6.acsta.net/r_1920_1080/medias/nmedia/18/35/52/32/18449720.jpg', "Tom Stall, un père de famille à la vie paisiblement tranquille, abat dans un réflexe de légitime défense son agresseur dans un restaurant. Il devient alors un personnage médiatique, dont l'existence est dorénavant connue du grand public... ", 2005,NULL, NULL, 9, 1);
