#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Client
#------------------------------------------------------------

CREATE TABLE Client(
        pseudo_client      Varchar (128) NOT NULL ,
        nom_client         Varchar (128) ,
        prenom_client      Varchar (128) ,
        age_client         Int ,
        email_client       Varchar (256) ,
        mdp_client         Varchar (256) ,
        premiere_connexion Bool ,
        poids              Int ,
        taille             Int ,
        nb_jour_semaine    Int ,
        pseudo_coach       Varchar (128) NOT NULL ,
        PRIMARY KEY (pseudo_client )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Coach
#------------------------------------------------------------

CREATE TABLE Coach(
        pseudo_coach     Varchar (128) NOT NULL ,
        nom_coach        Varchar (128) ,
        prenom_coach     Varchar (128) ,
        mdp_coach        Varchar (256) ,
        age_coach        Int ,
        annee_experience Int ,
        diplome          Varchar (256) ,
        mail_coach       Varchar (256) ,
        PRIMARY KEY (pseudo_coach )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Seance
#------------------------------------------------------------

CREATE TABLE Seance(
        id_seance         int (11) Auto_increment  NOT NULL ,
        nom_seance        Varchar (256) NOT NULL ,
        commentaire_coach Varchar (10000) ,
        pseudo_client     Varchar (128) NOT NULL ,
        PRIMARY KEY (id_seance )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Exercice
#------------------------------------------------------------

CREATE TABLE Exercice(
        id_exercice                int (11) Auto_increment  NOT NULL ,
        nom_exercice               Varchar (128) ,
        charge                     Varchar (128) ,
        temps_repos                Varchar (128) ,
        tempo                      Varchar (128) ,
        repetitions                Int ,
        commentaire_coach_exercice Varchar (1500) ,
        id_seance                  Int ,
        PRIMARY KEY (id_exercice )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Forum
#------------------------------------------------------------

CREATE TABLE Forum(
        theme_forum Varchar (128) NOT NULL ,
        description Varchar (512) ,
        PRIMARY KEY (theme_forum )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Sujet_Forum
#------------------------------------------------------------

CREATE TABLE Sujet_Forum(
        id_sujet              int (11) Auto_increment  NOT NULL ,
        nom_sujet             Varchar (256) ,
        debut_premier_message Varchar (128) ,
        theme_forum           Varchar (128) ,
        PRIMARY KEY (id_sujet )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Message_forum
#------------------------------------------------------------

CREATE TABLE Message_forum(
        id_message    int (11) Auto_increment  NOT NULL ,
        texte_message Varchar (10000) ,
        date_message  TimeStamp ,
        id_client     Int ,
        id_coach      Int ,
        id_sujet      Int ,
        pseudo_client Varchar (128) NOT NULL ,
        pseudo_coach  Varchar (128) NOT NULL ,
        PRIMARY KEY (id_message )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Seance_stat
#------------------------------------------------------------

CREATE TABLE Seance_stat(
        id_seance_stat    int (11) Auto_increment  NOT NULL ,
        nom_seance_stat   Varchar (256) ,
        commentaire_perso Varchar (10000) ,
        pseudo_client     Varchar (128) NOT NULL ,
        PRIMARY KEY (id_seance_stat )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Exercice_stat
#------------------------------------------------------------

CREATE TABLE Exercice_stat(
        id_exercice_stat  int (11) Auto_increment  NOT NULL ,
        nom_exercice_stat Varchar (128) ,
        charge            Varchar (128) ,
        temps_repos       Varchar (128) ,
        tempo             Varchar (128) ,
        repetition        Int ,
        id_seance_stat    Int ,
        PRIMARY KEY (id_exercice_stat )
)ENGINE=InnoDB;

ALTER TABLE Client ADD CONSTRAINT FK_Client_pseudo_coach FOREIGN KEY (pseudo_coach) REFERENCES Coach(pseudo_coach);
ALTER TABLE Seance ADD CONSTRAINT FK_Seance_pseudo_client FOREIGN KEY (pseudo_client) REFERENCES Client(pseudo_client);
ALTER TABLE Exercice ADD CONSTRAINT FK_Exercice_id_seance FOREIGN KEY (id_seance) REFERENCES Seance(id_seance);
ALTER TABLE Sujet_Forum ADD CONSTRAINT FK_Sujet_Forum_theme_forum FOREIGN KEY (theme_forum) REFERENCES Forum(theme_forum);
ALTER TABLE Message_forum ADD CONSTRAINT FK_Message_forum_id_sujet FOREIGN KEY (id_sujet) REFERENCES Sujet_Forum(id_sujet);
ALTER TABLE Message_forum ADD CONSTRAINT FK_Message_forum_pseudo_client FOREIGN KEY (pseudo_client) REFERENCES Client(pseudo_client);
ALTER TABLE Message_forum ADD CONSTRAINT FK_Message_forum_pseudo_coach FOREIGN KEY (pseudo_coach) REFERENCES Coach(pseudo_coach);
ALTER TABLE Seance_stat ADD CONSTRAINT FK_Seance_stat_pseudo_client FOREIGN KEY (pseudo_client) REFERENCES Client(pseudo_client);
ALTER TABLE Exercice_stat ADD CONSTRAINT FK_Exercice_stat_id_seance_stat FOREIGN KEY (id_seance_stat) REFERENCES Seance_stat(id_seance_stat);
