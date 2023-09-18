<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_type')->insert(['name' => 'Admin']);
        DB::table('user_type')->insert(['name' => 'Company']);
        DB::table('user_type')->insert(['name' => 'Student']);

        DB::table('users')->insert([
            'email' => 'admin@outreach.ca',
            'password' => bcrypt('password'),
            'user_type_id' => 1
        ]);

        DB::table('skillset')->insert(['name' => 'Database']);
        DB::table('skillset')->insert(['name' => 'Computer Science']);
        DB::table('skillset')->insert(['name' => 'JavaScript']);
        DB::table('skillset')->insert(['name' => '.Net']);
        DB::table('skillset')->insert(['name' => 'Technical']);
        DB::table('skillset')->insert(['name' => 'Collaboration']);
        DB::table('skillset')->insert(['name' => 'Innovation']);
        DB::table('skillset')->insert(['name' => 'Communication Skills']);
        DB::table('skillset')->insert(['name' => 'SQL']);
        DB::table('skillset')->insert(['name' => 'Documentation']);
        DB::table('skillset')->insert(['name' => 'Jquery']);
        DB::table('skillset')->insert(['name' => 'Angular JS']);
        DB::table('skillset')->insert(['name' => 'PHP']);
        DB::table('skillset')->insert(['name' => 'Google Cloud Platform (GCP)']);
        DB::table('skillset')->insert(['name' => 'Microsoft Azure']);
        DB::table('skillset')->insert(['name' => 'Amazon Web Services (AWS)']);
        DB::table('skillset')->insert(['name' => 'Ruby']);
        DB::table('skillset')->insert(['name' => 'Java']);
        DB::table('skillset')->insert(['name' => 'Python']);

        DB::table('college')->insert(['name' => 'Acsenda School of Management']);
        DB::table('college')->insert(['name' => 'Alexander College']);
        DB::table('college')->insert(['name' => 'British Columbia Institute of Technology']);
        DB::table('college')->insert(['name' => 'Cambria College']);
        DB::table('college')->insert(['name' => 'Camosun College']);
        DB::table('college')->insert(['name' => 'Canadian College']);
        DB::table('college')->insert(['name' => 'Coast Mountain College']);
        DB::table('college')->insert(['name' => 'College of New Caledonia']);
        DB::table('college')->insert(['name' => 'College of the Rockies']);
        DB::table('college')->insert(['name' => 'Columbia College']);
        DB::table('college')->insert(['name' => 'Cornerstone International Community College of Canada']);
        DB::table('college')->insert(['name' => 'Douglas College']);
        DB::table('college')->insert(['name' => 'Eton College']);
        DB::table('college')->insert(['name' => 'First College']);
        DB::table('college')->insert(['name' => 'Langara College']);
        DB::table('college')->insert(['name' => 'North Island College']);
        DB::table('college')->insert(['name' => 'Northern Lights College']);
        DB::table('college')->insert(['name' => 'Okanagan College']);
        DB::table('college')->insert(['name' => 'Royal Roads University']);
        DB::table('college')->insert(['name' => 'Selkirk College']);
        DB::table('college')->insert(['name' => 'Sprott Shaw College']);
        DB::table('college')->insert(['name' => 'Vancouver Community College']);
        DB::table('college')->insert(['name' => 'Vancouver Institute of Media Arts']);
        DB::table('college')->insert(['name' => 'Assiniboine Community College']);
        DB::table('college')->insert(['name' => 'Red River College']);
        DB::table('college')->insert(['name' => 'Robertson College']);
        DB::table('college')->insert(['name' => 'University College of the North']);
        DB::table('college')->insert(['name' => 'Manitoba Institute of Trades and Technology']);
        DB::table('college')->insert(['name' => 'Collège communautaire du Nouveau-Brunswick']);
        DB::table('college')->insert(['name' => 'Maritime College of Forest Technology']);
        DB::table('college')->insert(['name' => 'McKenzie College']);
        DB::table('college')->insert(['name' => 'New Brunswick College of Craft and Design']);
        DB::table('college')->insert(['name' => 'New Brunswick Community College']);
        DB::table('college')->insert(['name' => 'Oulton College']);
        DB::table('college')->insert(['name' => 'College of the North Atlantic']);
        DB::table('college')->insert(['name' => 'Aurora College']);
        DB::table('college')->insert(['name' => 'Collège nordique francophone']);
        DB::table('college')->insert(['name' => 'Canadian Coast Guard College']);
        DB::table('college')->insert(['name' => 'Gaelic College']);
        DB::table('college')->insert(['name' => 'Nova Scotia Community College']);
        DB::table('college')->insert(['name' => 'Nunavut Arctic College']);
        DB::table('college')->insert(['name' => 'Algonquin College']);
        DB::table('college')->insert(['name' => 'Cambrian College']);
        DB::table('college')->insert(['name' => 'Canadore College']);
        DB::table('college')->insert(['name' => 'Centennial College']);
        DB::table('college')->insert(['name' => 'Collège Boréal']);
        DB::table('college')->insert(['name' => 'Conestoga College']);
        DB::table('college')->insert(['name' => 'Confederation College']);
        DB::table('college')->insert(['name' => 'Durham College']);
        DB::table('college')->insert(['name' => 'The New College']);
        DB::table('college')->insert(['name' => 'Toulon Vocational College']);
        DB::table('college')->insert(['name' => 'Fanshawe College']);
        DB::table('college')->insert(['name' => 'Fleming College']);
        DB::table('college')->insert(['name' => 'George Brown College']);
        DB::table('college')->insert(['name' => 'Georgian College']);
        DB::table('college')->insert(['name' => 'Humber College']);
        DB::table('college')->insert(['name' => 'La Cité collégiale']);
        DB::table('college')->insert(['name' => 'Lambton College']);
        DB::table('college')->insert(['name' => 'Loyalist College']);
        DB::table('college')->insert(['name' => 'Mohawk College']);
        DB::table('college')->insert(['name' => 'Niagara College']);
        DB::table('college')->insert(['name' => 'Northern College']);
        DB::table('college')->insert(['name' => 'St. Clair College']);
        DB::table('college')->insert(['name' => 'St. Lawrence College']);
        DB::table('college')->insert(['name' => 'Sault College']);
        DB::table('college')->insert(['name' => 'Seneca College']);
        DB::table('college')->insert(['name' => 'Sheridan College']);
        DB::table('college')->insert(['name' => 'Springfield College Brampton']);
        DB::table('college')->insert(['name' => 'Collège de lÎle']);
        DB::table('college')->insert(['name' => 'Holland College']);
        DB::table('college')->insert(['name' => "Cégep de l'Abitibi-Témiscamingue, Rouyn-Noranda"]);
        DB::table('college')->insert(['name' => "Collège Ahuntsic, Ahuntsic, Montreal"]);
        DB::table('college')->insert(['name' => "Collège d'Alma, Alma"]);
        DB::table('college')->insert(['name' => "Cégep André-Laurendeau, LaSalle, Montreal"]);
        DB::table('college')->insert(['name' => "Cégep de Baie-Comeau, Baie-Comeau"]);
        DB::table('college')->insert(['name' => "Cégep Beauce-Appalaches, Saint-Georges"]);
        DB::table('college')->insert(['name' => "Collège de Bois-de-Boulogne, Cartierville, Montreal"]);
        DB::table('college')->insert(['name' => "Champlain Regional College"]);
        DB::table('college')->insert(['name' => "Cégep de Chicoutimi, Chicoutimi, Saguenay"]);
        DB::table('college')->insert(['name' => "Dawson College, Westmount, Montreal"]);
        DB::table('college')->insert(['name' => "Cégep de Drummondville, Drummondville"]);
        DB::table('college')->insert(['name' => "Cégep Édouard-Montpetit, Vieux-Longueuil, Longueuil"]);
        DB::table('college')->insert(['name' => "Cégep Garneau, La Cité, Quebec City"]);
        DB::table('college')->insert(['name' => "Cégep de la Gaspésie et des Îles, Gaspé"]);
        DB::table('college')->insert(['name' => "Collège Gérald-Godin, Sainte-Geneviève, Montreal"]);
        DB::table('college')->insert(['name' => "Cégep de Granby-Haute-Yamaska, Granby"]);
        DB::table('college')->insert(['name' => "Heritage College, Hull, Gatineau"]);
        DB::table('college')->insert(['name' => "John Abbott College, Sainte-Anne-de-Bellevue, Montreal"]);
        DB::table('college')->insert(['name' => "Cégep de Jonquière, Jonquière, Saguenay"]);
        DB::table('college')->insert(['name' => "Cégep de La Pocatière, La Pocatière"]);
        DB::table('college')->insert(['name' => "Cégep régional de Lanaudière"]);
        DB::table('college')->insert(['name' => "Cégep de Lévis, Lévis"]);
        DB::table('college')->insert(['name' => "Collège Montmorency, Laval"]);
        DB::table('college')->insert(['name' => "Cégep de Victoriaville, Victoriaville"]);
        DB::table('college')->insert(['name' => "OTHER"]);
    }
}

