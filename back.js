const oracledb = require('oracledb');

async function run() {
  let connection;

  try {
    // Configuration de la connexion
    connection = await oracledb.getConnection({
      user: "system",
      password: "123456789",
      connectString: "localhost:1521/XE"
    });

    console.log("Connexion réussie à Oracle DB!");

    // Exécuter une requête SQL
    const result = await connection.execute("SELECT * FROM employe");
    console.log(result.rows);
    
  } catch (err) {
    console.error("Erreur de connexion :", err);
  } 
  }

// Lancer la connexion
run();