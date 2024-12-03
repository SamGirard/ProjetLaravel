<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactsTableSeeder extends Seeder
{
    public function run(): void
    {

        DB::table('contacts')->insert([
            ['prenom' => 'Sophie', 'nom' => 'Lemoine', 'fonction' => 'Directrice Marketing', 'courriel' => 'sophie.lemoine@cirquedusoleil.com', 'typeNumTelephone' => 'Cellulaire', 'numTelephone' => '5141234567', 'poste' => 'Poste', 'fournisseur_id' => 1],
            ['prenom' => 'Marc', 'nom' => 'Dupuis', 'fonction' => 'Responsable des Ventes', 'courriel' => 'marc.dupuis@cirquedusoleil.com', 'typeNumTelephone' => 'Bureau', 'numTelephone' => '5147654321', 'poste' => 'Poste', 'fournisseur_id' => 1],
            ['prenom' => 'Émilie', 'nom' => 'Tremblay', 'fonction' => 'Directrice des Opérations', 'courriel' => 'emilie.tremblay@cascades.com', 'typeNumTelephone' => 'Cellulaire', 'numTelephone' => '8191237890', 'poste' => 'Poste', 'fournisseur_id' => 2],
            ['prenom' => 'Jean', 'nom' => 'Bouchard', 'fonction' => 'Analyste Financier', 'courriel' => 'jean.bouchard@cascades.com', 'typeNumTelephone' => 'Bureau', 'numTelephone' => '8192345678', 'poste' => 'Poste', 'fournisseur_id' => 2],
            ['prenom' => 'Alice', 'nom' => 'Côté', 'fonction' => 'Responsable Qualité', 'courriel' => 'alice.cote@cascades.com', 'typeNumTelephone' => 'Cellulaire', 'numTelephone' => '8193456789', 'poste' => 'Poste', 'fournisseur_id' => 3],
            ['prenom' => 'Philippe', 'nom' => 'Martin', 'fonction' => 'Vice-Président', 'courriel' => 'philippe.martin@bombardier.com', 'typeNumTelephone' => 'Cellulaire', 'numTelephone' => '5145678901', 'poste' => 'Poste', 'fournisseur_id' => 3],
            ['prenom' => 'Julie', 'nom' => 'Leroux', 'fonction' => 'Directrice de la Logistique', 'courriel' => 'julie.leroux@loblaw.ca', 'typeNumTelephone' => 'Cellulaire', 'numTelephone' => '5142345678', 'poste' => 'Poste', 'fournisseur_id' => 4],
            ['prenom' => 'Anne', 'nom' => 'Desjardins', 'fonction' => 'Responsable Marketing', 'courriel' => 'anne.desjardins@loblaw.ca', 'typeNumTelephone' => 'Cellulaire', 'numTelephone' => '5144567890', 'poste' => 'Poste', 'fournisseur_id' => 4],
            ['prenom' => 'Olivier', 'nom' => 'Girard', 'fonction' => 'Ingénieur de Projet', 'courriel' => 'olivier.girard@cae.com', 'typeNumTelephone' => 'Cellulaire', 'numTelephone' => '5147890123', 'poste' => 'Poste', 'fournisseur_id' => 5],
            ['prenom' => 'Isabelle', 'nom' => 'Fortier', 'fonction' => 'Directrice de la Communication', 'courriel' => 'isabelle.fortier@videotron.com', 'typeNumTelephone' => 'Cellulaire', 'numTelephone' => '5148901234', 'poste' => 'Poste', 'fournisseur_id' => 5],
            ['prenom' => 'David', 'nom' => 'Roy', 'fonction' => 'Chef de Projet TI', 'courriel' => 'david.roy@videotron.com', 'typeNumTelephone' => 'Bureau', 'numTelephone' => '5149012345', 'poste' => 'Poste', 'fournisseur_id' => 6],
            ['prenom' => 'Lucie', 'nom' => 'Caron', 'fonction' => 'Responsable des Ventes', 'courriel' => 'lucie.caron@videotron.com', 'typeNumTelephone' => 'Cellulaire', 'numTelephone' => '5140123456', 'poste' => 'Poste', 'fournisseur_id' => 6],
            ['prenom' => 'François', 'nom' => 'Lépine', 'fonction' => 'Directeur des Opérations', 'courriel' => 'francois.lepine@bell.ca', 'typeNumTelephone' => 'Cellulaire', 'numTelephone' => '5141234567', 'poste' => 'Poste', 'fournisseur_id' => 7],
            ['prenom' => 'Luc', 'nom' => 'Bernard', 'fonction' => 'Chef de Projet', 'courriel' => 'luc.bernard@bell.ca', 'typeNumTelephone' => 'Cellulaire', 'numTelephone' => '5143456789', 'poste' => 'Poste', 'fournisseur_id' => 7]
        ]);

    }
}