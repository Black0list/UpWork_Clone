CREATE TABLE Role (
    id SERIAL PRIMARY KEY,
    role_name VARCHAR(50),
    description TEXT
);


CREATE TABLE Utilisateur (
    id SERIAL PRIMARY KEY,
    firstname VARCHAR(50),
    lastname VARCHAR(50),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    role_id INT REFERENCES Role(id)
);


CREATE TABLE Skill (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(50),
    description TEXT
);


CREATE TABLE Category (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(50),
    description TEXT
);


CREATE TABLE Projet (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(100),
    description TEXT,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    category_id INT REFERENCES Category(id),
    status VARCHAR(20),
    freelancer_id INT REFERENCES Utilisateur(id),
    client_id INT REFERENCES Utilisateur(id)
);


CREATE TABLE Terms (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(50)
);


CREATE TABLE Contract (
    id SERIAL PRIMARY KEY,
    client_id INT REFERENCES Utilisateur(id),
    freelancer_id INT REFERENCES Utilisateur(id),
    projet_id INT REFERENCES Projet(id),
    terms_id INT REFERENCES Terms(id),
    status VARCHAR(20)
);


CREATE TABLE Proposal (
    id SERIAL PRIMARY KEY,
    freelancer_id INT REFERENCES Utilisateur(id),
    projet_id INT REFERENCES Projet(id),
    quote TEXT,
    status VARCHAR(20),
    client_id INT REFERENCES Utilisateur(id)
);


CREATE TABLE Paiement (
    id SERIAL PRIMARY KEY,
    method VARCHAR(50),
    date DATE,
    user_id INT REFERENCES Utilisateur(id)
);

CREATE TABLE Review (
    id SERIAL PRIMARY KEY,
    reviewer_id INT REFERENCES Utilisateur(id),
    reviewed_id INT REFERENCES Utilisateur(id),
    review TEXT
);

CREATE TABLE Conversation (
    id SERIAL PRIMARY KEY,
    user1_id INT REFERENCES Utilisateur(id),
    user2_id INT REFERENCES Utilisateur(id),
    projet_id INT REFERENCES Projet(id)
);

CREATE TABLE Message (
    id SERIAL PRIMARY KEY,
    sender_id INT REFERENCES Utilisateur(id),
    receiver_id INT REFERENCES Utilisateur(id),
    date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    content TEXT,
    is_read BOOLEAN DEFAULT FALSE
);

CREATE TABLE Utilisateur_Skill (
    utilisateur_id INT REFERENCES Utilisateur(id),
    skill_id INT REFERENCES Skill(id),
    PRIMARY KEY (utilisateur_id, skill_id)
);

CREATE TABLE Projet_Terms (
    projet_id INT REFERENCES Projet(id),
    term_id INT REFERENCES Terms(id),
    PRIMARY KEY (projet_id, term_id)
);
