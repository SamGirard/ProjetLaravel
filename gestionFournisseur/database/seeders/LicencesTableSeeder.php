<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LicencesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('licences')->insert([
            ['Numéro' => '1.1.1', 'Categorie' => 1, 'Titre' => 'Entrepreneur en bâtiments résidentiels neufs visés à un plan de garantie, classe 1'],
            ['Numéro' => '1.1.2', 'Categorie' => 1, 'Titre' => 'Entrepreneur en bâtiments résidentiels neufs visés à un plan de garantie, classe 2'],
            ['Numéro' => '1.2', 'Categorie' => 1, 'Titre' => 'Entrepreneur en petits bâtiments'],
            ['Numéro' => '1.3', 'Categorie' => 1, 'Titre' => 'Entrepreneur en bâtiments de tout genre'],
            ['Numéro' => '1.4', 'Categorie' => 1, 'Titre' => 'Entrepreneur en routes et canalisation'],
            ['Numéro' => '1.5', 'Categorie' => 1, 'Titre' => 'Entrepreneur en structures d’ouvrages de génie civil'],
            ['Numéro' => '1.6', 'Categorie' => 1, 'Titre' => 'Entrepreneur en ouvrages de génie civil immergés'],
            ['Numéro' => '1.7', 'Categorie' => 1, 'Titre' => 'Entrepreneur en télécommunication, transport, transformation et distribution d’énergie électrique'],
            ['Numéro' => '1.8', 'Categorie' => 1, 'Titre' => 'Entrepreneur en installation d’équipements pétroliers'],
            ['Numéro' => '1.9', 'Categorie' => 1, 'Titre' => 'Entrepreneur en mécanique du bâtiment'],
            ['Numéro' => '1.10', 'Categorie' => 1, 'Titre' => 'Entrepreneur en remontées mécaniques'],
            ['Numéro' => '2.1', 'Categorie' => 2, 'Titre' => 'Entrepreneur en puits forés'],
            ['Numéro' => '2.2', 'Categorie' => 2, 'Titre' => 'Entrepreneur en ouvrages de captage d’eau non forés'],
            ['Numéro' => '2.3', 'Categorie' => 2, 'Titre' => 'Entrepreneur en systèmes de pompage des eaux souterraines'],
            ['Numéro' => '2.4', 'Categorie' => 2, 'Titre' => 'Entrepreneur en systèmes d’assainissement autonome'],
            ['Numéro' => '2.5', 'Categorie' => 3, 'Titre' => 'Entrepreneur en excavation et terrassement'],
            ['Numéro' => '2.6', 'Categorie' => 2, 'Titre' => 'Entrepreneur en pieux et fondations spéciales'],
            ['Numéro' => '2.7', 'Categorie' => 3, 'Titre' => 'Entrepreneur en travaux d’emplacement'],
            ['Numéro' => '2.8', 'Categorie' => 2, 'Titre' => 'Entrepreneur en sautage'],
            ['Numéro' => '3.1', 'Categorie' => 2, 'Titre' => 'Entrepreneur en structures de béton'],
            ['Numéro' => '3.2', 'Categorie' => 3, 'Titre' => 'Entrepreneur en petits ouvrages de béton'],
            ['Numéro' => '4.1', 'Categorie' => 2, 'Titre' => 'Entrepreneur en structures de maçonnerie'],
            ['Numéro' => '4.2', 'Categorie' => 3, 'Titre' => 'Entrepreneur en travaux de maçonnerie non structurale, marbre et céramique'],
            ['Numéro' => '5.1', 'Categorie' => 2, 'Titre' => 'Entrepreneur en structures métalliques et éléments préfabriqués de béton'],
            ['Numéro' => '5.2', 'Categorie' => 3, 'Titre' => 'Entrepreneur en ouvrages métalliques'],
            ['Numéro' => '6.1', 'Categorie' => 2, 'Titre' => 'Entrepreneur en charpentes de bois'],
            ['Numéro' => '6.2', 'Categorie' => 3, 'Titre' => 'Entrepreneur en travaux de bois et plastique'],
            ['Numéro' => '7.0', 'Categorie' => 3, 'Titre' => 'Entrepreneur en isolation, étanchéité, couvertures et revêtements extérieurs'],
            ['Numéro' => '8.0', 'Categorie' => 3, 'Titre' => 'Entrepreneur en portes et fenêtres'],
            ['Numéro' => '9.0', 'Categorie' => 3, 'Titre' => 'Entrepreneur en travaux de finition'],
            ['Numéro' => '10.0', 'Categorie' => 2, 'Titre' => 'Entrepreneur en systèmes de chauffage localisé à combustible solide'],
            ['Numéro' => '11.1', 'Categorie' => 2, 'Titre' => 'Entrepreneur en tuyauterie industrielle ou institutionnelle sous pression'],
            ['Numéro' => '11.2', 'Categorie' => 3, 'Titre' => 'Entrepreneur en équipements et produits spéciaux'],
            ['Numéro' => '12.0', 'Categorie' => 3, 'Titre' => 'Entrepreneur en armoires et comptoirs usinés'],
            ['Numéro' => '13.1', 'Categorie' => 2, 'Titre' => 'Entrepreneur en protection contre la foudre'],
            ['Numéro' => '13.2', 'Categorie' => 2, 'Titre' => 'Entrepreneur en systèmes d’alarme incendie'],
            ['Numéro' => '13.3', 'Categorie' => 2, 'Titre' => 'Entrepreneur en systèmes d’extinction d’incendie'],
            ['Numéro' => '13.4', 'Categorie' => 2, 'Titre' => 'Entrepreneur en systèmes localisés d’extinction incendie'],
            ['Numéro' => '13.5', 'Categorie' => 3, 'Titre' => 'Entrepreneur en installations spéciales ou préfabriquées'],
            ['Numéro' => '14.1', 'Categorie' => 2, 'Titre' => 'Entrepreneur en ascenseurs et monte-charges'],
            ['Numéro' => '14.2', 'Categorie' => 2, 'Titre' => 'Entrepreneur en appareils élévateurs pour personnes handicapées'],
            ['Numéro' => '14.3', 'Categorie' => 2, 'Titre' => 'Entrepreneur en autres types d’appareils élévateurs'],
            ['Numéro' => '15.1', 'Categorie' => 2, 'Titre' => 'Entrepreneur en systèmes de chauffage à air pulsé'],
            ['Numéro' => '15.1.1', 'Categorie' => 2, 'Titre' => 'Entrepreneur en systèmes de chauffage à air pulsé pour certains travaux qui ne sont pas réservés exclusivement aux maîtres mécaniciens en tuyauterie'],
            ['Numéro' => '15.2', 'Categorie' => 2, 'Titre' => 'Entrepreneur en systèmes de brûleurs au gaz naturel'],
            ['Numéro' => '15.2.1', 'Categorie' => 2, 'Titre' => 'Entrepreneur en systèmes de brûleurs au gaz naturel pour certains travaux qui ne sont pas réservés exclusivement aux maîtres mécaniciens en tuyauterie'],
            ['Numéro' => '15.3', 'Categorie' => 2, 'Titre' => 'Entrepreneur en systèmes de brûleurs à l’huile'],
            ['Numéro' => '15.3.1', 'Categorie' => 2, 'Titre' => 'Entrepreneur en systèmes de brûleurs à l’huile pour certains travaux qui ne sont pas réservés exclusivement aux maîtres mécaniciens en tuyauterie'],
            ['Numéro' => '15.4', 'Categorie' => 2, 'Titre' => 'Entrepreneur en systèmes de chauffage hydronique'],
            ['Numéro' => '15.4.1', 'Categorie' => 2, 'Titre' => 'Entrepreneur en systèmes de chauffage hydronique pour certains travaux qui ne sont pas réservés exclusivement aux maîtres mécaniciens en tuyauterie'],
            ['Numéro' => '15.5', 'Categorie' => 2, 'Titre' => 'Entrepreneur en plomberie'],
            ['Numéro' => '15.5.1', 'Categorie' => 2, 'Titre' => 'Entrepreneur en plomberie pour certains travaux qui ne sont pas réservés exclusivement aux maîtres mécaniciens en tuyauterie'],
            ['Numéro' => '15.6', 'Categorie' => 2, 'Titre' => 'Entrepreneur en propane'],
            ['Numéro' => '15.7', 'Categorie' => 2, 'Titre' => 'Entrepreneur en ventilation résidentielle'],
            ['Numéro' => '15.8', 'Categorie' => 2, 'Titre' => 'Entrepreneur en ventilation'],
            ['Numéro' => '15.9', 'Categorie' => 2, 'Titre' => 'Entrepreneur en petits systèmes de réfrigération'],
            ['Numéro' => '15.10', 'Categorie' => 2, 'Titre' => 'Entrepreneur en réfrigération'],
            ['Numéro' => '16.0', 'Categorie' => 2, 'Titre' => 'Entrepreneur en électricité'],
            ['Numéro' => '17.1', 'Categorie' => 2, 'Titre' => 'Entrepreneur en instrumentation, contrôle et régulation'],
            ['Numéro' => '17.2', 'Categorie' => 3, 'Titre' => 'Entrepreneur en intercommunication, téléphonie et surveillance']
    ]);
    }
}
