<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('services')->insert([
            [
                'rbq' => '1234567890',
                'type_licence' => 'General Contractor',
                'statut' => 'Active',
                'categorie_generale' => json_encode(['Construction', 'Engineering']),
                'categorie_specialise' => json_encode(['Residential', 'Commercial']),
                'produit_services' => json_encode(["Approvisionnement/G1 - Aérospatiale/25191503/Systèmes intégrés d'information sur la maintenance/Matériel auxiliaire de transport", "Approvisionnement/G8 - Matériel et logiciel informatique/32101602/Mémoire vive dynamique (DRAM)/Circuit imprimé, circuit intégré et microassemblage"]),
                'details' => 'Provides building and consulting services for large-scale projects.',
                'fournisseur_id' => 1,
            ],
            [
                'rbq' => '0987654321',
                'type_licence' => 'Specialized Contractor',
                'statut' => 'Pending',
                'categorie_generale' => json_encode(['Waste Management']),
                'categorie_specialise' => json_encode(['Recycling', 'Waste Disposal']),
                'produit_services' => json_encode(["Approvisionnement/G1 - Aérospatiale/25191503/Systèmes intégrés d'information sur la maintenance/Matériel auxiliaire de transport", "Approvisionnement/G8 - Matériel et logiciel informatique/32101602/Mémoire vive dynamique (DRAM)/Circuit imprimé, circuit intégré et microassemblage"]),
                'details' => 'Specializes in recycling and waste disposal services.',
                'fournisseur_id' => 2,
            ],
            [
                'rbq' => '2345678901',
                'type_licence' => 'Aviation',
                'statut' => 'Inactive',
                'categorie_generale' => json_encode(['Aerospace']),
                'categorie_specialise' => json_encode(['Manufacturing', 'Consulting']),
                'produit_services' => json_encode(["Approvisionnement/G1 - Aérospatiale/25191503/Systèmes intégrés d'information sur la maintenance/Matériel auxiliaire de transport", "Approvisionnement/G8 - Matériel et logiciel informatique/32101602/Mémoire vive dynamique (DRAM)/Circuit imprimé, circuit intégré et microassemblage"]),
                'details' => 'Provides parts and technical support for aerospace projects.',
                'fournisseur_id' => 3,
            ],
            [
                'rbq' => '3456789012',
                'type_licence' => 'Retail',
                'statut' => 'Active',
                'categorie_generale' => json_encode(['Food', 'Pharmaceutical']),
                'categorie_specialise' => json_encode(['Grocery', 'Pharmacy']),
                'produit_services' => json_encode(["Approvisionnement/G1 - Aérospatiale/25191503/Systèmes intégrés d'information sur la maintenance/Matériel auxiliaire de transport", "Approvisionnement/G8 - Matériel et logiciel informatique/32101602/Mémoire vive dynamique (DRAM)/Circuit imprimé, circuit intégré et microassemblage"]),
                'details' => 'Operates as a grocery and pharmacy retailer across multiple regions.',
                'fournisseur_id' => 4,
            ],
            [
                'rbq' => '4567890123',
                'type_licence' => 'Simulation Technology',
                'statut' => 'Inactive',
                'categorie_generale' => json_encode(['Technology']),
                'categorie_specialise' => json_encode(['Simulations', 'Training']),
                'produit_services' => json_encode(["Approvisionnement/G1 - Aérospatiale/25191503/Systèmes intégrés d'information sur la maintenance/Matériel auxiliaire de transport", "Approvisionnement/G8 - Matériel et logiciel informatique/32101602/Mémoire vive dynamique (DRAM)/Circuit imprimé, circuit intégré et microassemblage"]),
                'details' => 'Develops simulators and training software for aviation.',
                'fournisseur_id' => 5,
            ],
            [
                'rbq' => '5678901234',
                'type_licence' => 'Telecommunications',
                'statut' => 'Active',
                'categorie_generale' => json_encode(['Media', 'Telecommunications']),
                'categorie_specialise' => json_encode(['Internet', 'Television']),
                'produit_services' => json_encode(["Approvisionnement/G8 - Matériel et logiciel informatique/32101602/Mémoire vive dynamique (DRAM)/Circuit imprimé, circuit intégré et microassemblage"]),
                'details' => 'Offers internet and television services across Québec.',
                'fournisseur_id' => 6,
            ],
            [
                'rbq' => '6789012345',
                'type_licence' => 'Telecommunications',
                'statut' => 'Active',
                'categorie_generale' => json_encode(['Telecommunications']),
                'categorie_specialise' => json_encode(['Mobile', 'Home Phone']),
                'produit_services' => json_encode(["Approvisionnement/G8 - Matériel et logiciel informatique/32101602/Mémoire vive dynamique (DRAM)/Circuit imprimé, circuit intégré et microassemblage", "Approvisionnement/G1 - Aérospatiale/25191503/Systèmes intégrés d'information sur la maintenance/Matériel auxiliaire de transport"]),
                'details' => 'Provides mobile and home phone services nationwide.',
                'fournisseur_id' => 7,
            ],
        ]);
    }
}
