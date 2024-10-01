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
            ['prenom' => 'Sophie', 'nom' => 'Lemoine', 'fonction' => 'Directrice Marketing', 'courriel' => 'sophie.lemoine@cirquedusoleil.com', 'typeNumTelephone' => 'Cellulaire', 'numTelephone' => '5141234567', 'poste' => 'Poste', 'neqFournisseur' => 1140030355, 'courrielFournisseur' => 'info@cirquedusoleil.com'],
            ['prenom' => 'Marc', 'nom' => 'Dupuis', 'fonction' => 'Responsable des Ventes', 'courriel' => 'marc.dupuis@cirquedusoleil.com', 'typeNumTelephone' => 'Bureau', 'numTelephone' => '5147654321', 'poste' => 'Poste', 'neqFournisseur' => 1140030355, 'courrielFournisseur' => 'info@cirquedusoleil.com'],
            ['prenom' => 'Émilie', 'nom' => 'Tremblay', 'fonction' => 'Directrice des Opérations', 'courriel' => 'emilie.tremblay@cascades.com', 'typeNumTelephone' => 'Cellulaire', 'numTelephone' => '8191237890', 'poste' => 'Poste', 'neqFournisseur' => 1168420345, 'courrielFournisseur' => 'info@cascades.com'],
            ['prenom' => 'Jean', 'nom' => 'Bouchard', 'fonction' => 'Analyste Financier', 'courriel' => 'jean.bouchard@cascades.com', 'typeNumTelephone' => 'Bureau', 'numTelephone' => '8192345678', 'poste' => 'Poste', 'neqFournisseur' => 1168420345, 'courrielFournisseur' => 'info@cascades.com'],
            ['prenom' => 'Alice', 'nom' => 'Côté', 'fonction' => 'Responsable Qualité', 'courriel' => 'alice.cote@cascades.com', 'typeNumTelephone' => 'Cellulaire', 'numTelephone' => '8193456789', 'poste' => 'Poste', 'neqFournisseur' => 1168420345, 'courrielFournisseur' => 'info@cascades.com'],
            ['prenom' => 'Philippe', 'nom' => 'Martin', 'fonction' => 'Vice-Président', 'courriel' => 'philippe.martin@bombardier.com', 'typeNumTelephone' => 'Cellulaire', 'numTelephone' => '5145678901', 'poste' => 'Poste', 'neqFournisseur' => 1143313945, 'courrielFournisseur' => 'contact@bombardier.com'],
            ['prenom' => 'Julie', 'nom' => 'Leroux', 'fonction' => 'Directrice de la Logistique', 'courriel' => 'julie.leroux@loblaw.ca', 'typeNumTelephone' => 'Cellulaire', 'numTelephone' => '5142345678', 'poste' => 'Poste', 'neqFournisseur' => 1142249510, 'courrielFournisseur' => 'support@loblaw.ca'],
            ['prenom' => 'Anne', 'nom' => 'Desjardins', 'fonction' => 'Responsable Marketing', 'courriel' => 'anne.desjardins@loblaw.ca', 'typeNumTelephone' => 'Cellulaire', 'numTelephone' => '5144567890', 'poste' => 'Poste', 'neqFournisseur' => 1142249510, 'courrielFournisseur' => 'support@loblaw.ca'],
            ['prenom' => 'Olivier', 'nom' => 'Girard', 'fonction' => 'Ingénieur de Projet', 'courriel' => 'olivier.girard@cae.com', 'typeNumTelephone' => 'Cellulaire', 'numTelephone' => '5147890123', 'poste' => 'Poste', 'neqFournisseur' => 1168030340, 'courrielFournisseur' => 'contact@cae.com'],
            ['prenom' => 'Isabelle', 'nom' => 'Fortier', 'fonction' => 'Directrice de la Communication', 'courriel' => 'isabelle.fortier@videotron.com', 'typeNumTelephone' => 'Cellulaire', 'numTelephone' => '5148901234', 'poste' => 'Poste', 'neqFournisseur' => 1140045612, 'courrielFournisseur' => 'info@videotron.com'],
            ['prenom' => 'David', 'nom' => 'Roy', 'fonction' => 'Chef de Projet TI', 'courriel' => 'david.roy@videotron.com', 'typeNumTelephone' => 'Bureau', 'numTelephone' => '5149012345', 'poste' => 'Poste', 'neqFournisseur' => 1140045612, 'courrielFournisseur' => 'info@videotron.com'],
            ['prenom' => 'Lucie', 'nom' => 'Caron', 'fonction' => 'Responsable des Ventes', 'courriel' => 'lucie.caron@videotron.com', 'typeNumTelephone' => 'Cellulaire', 'numTelephone' => '5140123456', 'poste' => 'Poste', 'neqFournisseur' => 1140045612, 'courrielFournisseur' => 'info@videotron.com'],
            ['prenom' => 'François', 'nom' => 'Lépine', 'fonction' => 'Directeur des Opérations', 'courriel' => 'francois.lepine@bell.ca', 'typeNumTelephone' => 'Cellulaire', 'numTelephone' => '5141234567', 'poste' => 'Poste', 'neqFournisseur' => 1143207234, 'courrielFournisseur' => 'contact@bell.ca'],
            ['prenom' => 'Luc', 'nom' => 'Bernard', 'fonction' => 'Chef de Projet', 'courriel' => 'luc.bernard@bell.ca', 'typeNumTelephone' => 'Cellulaire', 'numTelephone' => '5143456789', 'poste' => 'Poste', 'neqFournisseur' => 1143207234, 'courrielFournisseur' => 'contact@bell.ca']
        ]);
    }
}