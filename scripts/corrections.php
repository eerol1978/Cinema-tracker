<?
function fixOriginalTitle($title){
	if($title == "Pirates of the Caribbean:Salazar’s Revenge") {$title = "Pirates of the Caribbean: Salazar's Revenge";}
	if($title == 'Green Cats') {$title = 'Rohelised kassid';}
	if($title == 'Insidious: Chapter 4') {$title = 'Insidious: The Last Key';}
	if($title == 'Star Wars: Episode VIII - The Last Jedi') {$title = 'Star Wars: The Last Jedi';}
	if($title == 'The Justice League Part One') {$title = 'Justice League';}
	if($title == 'Mehetapja. Süütu. Vari') {$title = 'Mehetapja / Süütu / Vari';}
	if($title == 'Jumanji') {$title = 'Jumanji: Welcome to the Jungle';}
	if($title == 'Igitee') {$title = 'Ikitie';}
	if($title == 'Selfie') {$title = 'Селфи';}
	if($title == 'Estonian soil and Estonian Ruja') {$title = 'Eesti muld ja Eesti Ruja';}
	if($title == 'Condorito: The Movie' or $title == 'Condorito') {$title = 'Condorito: La Película';}
	if($title == 'Женщины против мужчин: Крымские каникулы') {$title = 'Женщины против мужчин 2: Крымские каникулы';}
	if($title == 'Лед') {$title = 'Лёд';}
	if($title == 'Klassikokkutulek 2: Pulmad ja matused') {$title = 'Klassikokkutulek 2';}
	if($title == 'Hilfe, ich habe meine Eltern geschrumpft' or $title == 'Hilfe, ich hab meine Eltern geshrumpft') {$title = 'Hilfe, ich hab meine Eltern geschrumpft';}
	if($title == 'Music of Silence') {$title = 'La musica del silenzio';}
	if($title == 'Ahto. Chasing a Dream') {$title = 'Ahto. Unistuste jaht';}
	if($title == 'Racer and the Jailbird') {$title = 'Le Fidèle';}
	if($title == 'The Little Comrade') {$title = 'Seltsimees laps';}
	if($title == 'Pacific Rim Uprising') {$title = 'Pacific Rim: Uprising';}
	if($title == 'Ploey') {$title = 'Ploey - You Never Fly Alone';}
	if($title == 'Ploey. You Never Fly Alone') {$title = 'Ploey - You Never Fly Alone';}
	if($title == 'Lino') {$title = 'Lino: Uma Aventura de Sete Vidas';}
	if($title == 'Kimi no na wa...' or $title =='jaff2018yourname') {$title = 'Kimi no na wa.';}
	if($title == 'Johnny English 3') {$title = 'Johnny English Strikes Again';}
	if($title == 'Klassikokkutulek 3') {$title = 'Klassikokkutulek 3: Ristiisad';}
	if($title == 'Class Reunion 3: Godfathers') {$title = 'Klassikokkutulek 3: Ristiisad';}
	if($title == 'Lotte and the Lost Dragon') {$title = 'Lotte ja kadunud lohed';}
	if($title == 'Ralph Breaks the Internet') {$title = 'Ralph Breaks the Internet: Wreck-It Ralph 2';}
	$title = str_replace('(in Russian)', '', $title);
	$title = str_replace('(RUS DUB)', '', $title);
	return trim($title);
}

function fixTheatre($theatre){
	$theatre = str_replace('Apollo Kino Mustamäe', 'Mustamäe', $theatre);
	$theatre = str_replace('Apollo Kino Solaris', 'Solaris', $theatre);
	$theatre = str_replace('Kosmos IMAX', 'Kosmos', $theatre);
	$theatre = str_replace('KOSMOS', 'Kosmos', $theatre);
	$theatre = str_replace('Cinamon Kosmos', 'Kosmos', $theatre);
	$theatre = str_replace('Coca Cola Plaza', 'CC Plaza', $theatre);
	$theatre = str_replace('Apollo Kino Lõunakeskus', 'Lõunakeskus', $theatre);
	$theatre = str_replace('Cinamon Tartu', 'Cinamon', $theatre);
	$theatre = str_replace('Apollo Kino Pärnu', 'Pärnu Keskus', $theatre);
	$theatre = str_replace('Apollo Kino Astri', 'Astri Keskus', $theatre);
	$theatre = str_replace('Apollo Kino Saaremaa', 'Auriga Keskus', $theatre);
	$theatre = str_replace('Apollo Kino Kristiine', 'Kristiine', $theatre);
	$theatre = str_replace('Apollo Kino Ülemiste', 'Ülemiste', $theatre);
	$theatre = str_replace('T1.cinamonkino.com', 'T1', $theatre);
  return trim($theatre);
}
function fixTitle($title){
	$title = str_replace('(vene keeles)', '', $title);
	$title = str_replace(' IMAX 3D', '', $title);
	$title = str_replace(' IMAX 2D', '', $title);
	$title = str_replace('IMAX', '', $title);
	$title = str_replace(' 2D', '', $title);
	$title = str_replace(' 3D', '', $title);
	$title = str_replace('(RUS)', '', $title);
	$title = str_replace('(EST)', '', $title);
	$title = str_replace('5D', '', $title);
	$title = str_replace('KINOKLASSIKA: ', '', $title);
	$title = str_replace('&', '&amp;', $title);
	$title = str_replace("'", "%27", $title);
	$title = str_replace("´", "%27", $title);
	$title = str_replace("’", "%27", $title);
	return trim($title);
}

function fixLanguage($methodlanguage){
	$methodlanguage = strtolower($methodlanguage);
	$methodlanguage = str_replace('2d ', '', $methodlanguage);
	$methodlanguage = str_replace('3d ', '', $methodlanguage);
	$methodlanguage = str_replace('2d, ', '', $methodlanguage);
	$methodlanguage = str_replace('3d, ', '', $methodlanguage);
	$methodlanguage = str_replace('2d', '', $methodlanguage);
	$methodlanguage = str_replace('3d', '', $methodlanguage);
	$methodlanguage = str_replace('5d, eesti keeles', '', $methodlanguage);
	$methodlanguage = str_replace('5d', '', $methodlanguage);
	$methodlanguage = str_replace('imax ', '', $methodlanguage);
	$methodlanguage = str_replace('imax', '', $methodlanguage);
	$methodlanguage = str_replace('jaff', '', $methodlanguage);
	$methodlanguage = str_replace('ee subs. en aud. ru subs.', '', $methodlanguage);
	$methodlanguage = str_replace('ru aud.', 'Vene keeles', $methodlanguage);
	$methodlanguage = str_replace('ee aud.', 'Eesti keeles', $methodlanguage);
	$methodlanguage = str_replace('en aud.', '', $methodlanguage);
	$methodlanguage = str_replace('ja aud.', 'Jaapani keeles', $methodlanguage);
	$methodlanguage = str_replace('es aud.', 'Hispaania keeles', $methodlanguage);
	$methodlanguage = str_replace('spanish', 'Hispaania keeles', $methodlanguage);
	$methodlanguage = str_replace('eellinastu ', '', $methodlanguage);
	$methodlanguage = str_replace('hungarian', 'Ungari keeles', $methodlanguage);
	$methodlanguage = str_replace('ee subs.', '', $methodlanguage);
	$methodlanguage = str_replace('en subs.', '', $methodlanguage);
	$methodlanguage = str_replace('ru subs.', '', $methodlanguage);
	$methodlanguage = str_replace('hitid', '', $methodlanguage);
	$methodlanguage = str_replace('doc ', '', $methodlanguage);
	$methodlanguage = str_replace('opera', '', $methodlanguage);
	$methodlanguage = str_replace('erilinastu', '', $methodlanguage);
	$methodlanguage = str_replace('esilinastu', '', $methodlanguage);
	$methodlanguage = str_replace('oscar', '', $methodlanguage);
	return ucfirst(trim($methodlanguage));
}

function correctTitle($title){
	$title = str_replace("%27", "'", $title);
  if($title == 'Ikitie') {$title = 'Igitee';}
  return $title;
}

function fixSynopsis($text) {
  $text = str_replace("'", "%27", $text);
	$text = str_replace("´", "%27", $text);
	$text = str_replace("’", "%27", $text);
  return trim($text);
}

function unfixSynopsis($text) {
  $text = str_replace("%27", "'", $text);
  return trim($text);
}

function fixAuditorium($auditorium){
	$auditorium = str_replace('Grand Rose Saal', 'Grand Rose', $auditorium);
	$auditorium = str_replace('KUBRICK', 'Kubrick', $auditorium);
	$auditorium = str_replace('LEM', 'Lem', $auditorium);
	$auditorium = str_replace('Premia Saal', 'Premia', $auditorium);
	$auditorium = str_replace('A.Le Coq Sviit', 'A.Le Coq', $auditorium);
	$auditorium = str_replace('V-Klubi Saal', 'V-Klubi', $auditorium);
	$auditorium = str_replace('TV3 Saal', 'TV3', $auditorium);
	$auditorium = str_replace('Scape Saal', 'Scape', $auditorium);
	$auditorium = str_replace('1. Apollo MAX', 'Max', $auditorium);
	$auditorium = str_replace('1. Saku saal', 'Saku', $auditorium);
	$auditorium = str_replace('2. Saku saal', 'Saku', $auditorium);
	$auditorium = str_replace('2. Telia saal', 'Telia', $auditorium);
	$auditorium = str_replace('3. Telia saal', 'Telia', $auditorium);
	$auditorium = str_replace('1. saal', 'Saal 1', $auditorium);
	$auditorium = str_replace('2. saal', 'Saal 2', $auditorium);
	$auditorium = str_replace('SAAL 2', 'Saal 2', $auditorium);
	$auditorium = str_replace('KOSMOS', 'Kosmos', $auditorium);
	$auditorium = str_replace('3. saal', 'Saal 3', $auditorium);
	$auditorium = str_replace('SAAL 3', 'Saal 3', $auditorium);
	$auditorium = str_replace('4. saal', 'Saal 4', $auditorium);
	$auditorium = str_replace('SAAL 4', 'Saal 4', $auditorium);
	$auditorium = str_replace('5. saal', 'Saal 5', $auditorium);
	$auditorium = str_replace('SAAL 5', 'Saal 5', $auditorium);
	$auditorium = str_replace('6. saal', 'Saal 6', $auditorium);
	$auditorium = str_replace('SAAL 6', 'Saal 6', $auditorium);
	$auditorium = str_replace('7. saal', 'Saal 7', $auditorium);
	$auditorium = str_replace('8. saal', 'Saal 8', $auditorium);
	$auditorium = str_replace('9. saal', 'Saal 9', $auditorium);
	$auditorium = str_replace('IMAX.', 'IMAX', $auditorium);
	$auditorium = str_replace('3. Apollo Kinorestoran', 'Kinorestoran', $auditorium);
	$auditorium = str_replace('4. Tallink saal', 'Tallink', $auditorium);
	$auditorium = str_replace('1. Apollo Teatrisaal', 'Teatrisaal', $auditorium);
	return trim($auditorium);
}

function fixGenres($genres){
  $genres = strtolower($genres);
  $genres = str_replace('(none)', '', $genres);
	$genres = str_replace('n/a', '', $genres);
	$genres = str_replace('5d', '', $genres);
	$genres = str_replace('action', 'Märul', $genres);
  $genres = str_replace('family', 'Perefilm', $genres);
  $genres = str_replace('kogupere', 'Perefilm', $genres);
	$genres = str_replace('perefilmfilm', 'Perefilm', $genres);
	$genres = str_replace('comedy', 'Komöödia', $genres);
  $genres = str_replace('kriminaalfilm', 'Krimi', $genres);
  $genres = str_replace('ulmefilm', 'Ulme', $genres);
	$genres = str_replace('eluloofilm', 'Biograafia', $genres);
  $genres = str_replace('dokumentaalfilm', 'Dokumentaal', $genres);
  $genres = str_replace('thriller', 'Põnevik', $genres);
  $genres = str_replace('põnevus', 'Põnevik', $genres);
	$genres = str_replace('põnevikfilm', 'Põnevik', $genres);
	$genres = str_replace('musical', 'Muusikal', $genres);
	$genres = str_replace('romance', 'Romantika', $genres);
	$genres = str_replace('animation', 'Animatsioon', $genres);
	$genres = str_replace('adventure', 'Seiklus', $genres);
	$genres = str_replace('crime', 'Krimi', $genres);
	$genres = str_replace('drama', 'Draama', $genres);
	$genres = str_replace('mystery', 'Müsteerium', $genres);
	$genres = str_replace('history', 'Ajalugu', $genres);
	$genres = str_replace('horror', 'Õudus', $genres);
	$genres = str_replace('fantasy', 'Fantaasia', $genres);
	$genres = str_replace('sci-fi', 'Ulme', $genres);
  return trim($genres);
}

function fixRating($rating){
	$rating = str_replace('(none)', '', $rating);
	$rating = str_replace('Alla 18-aastastele keelatud!', 'Alla 18 a. keelatud', $rating);
	$rating = str_replace('Alla 16-aastastele keelatud!', 'Alla 16 a. keelatud', $rating);
	$rating = str_replace('Alla 14-aastastele keelatud!', 'Alla 14 a. keelatud', $rating);
	$rating = str_replace('Alla 14 a. Keelatud', 'Alla 14 a. keelatud', $rating);
	$rating = str_replace('Alla 12-aastastele keelatud!', 'Alla 12 a. keelatud', $rating);
	$rating = str_replace('K-18', 'Alla 18 a. keelatud', $rating);
	$rating = str_replace('K-16', 'Alla 16 a. keelatud', $rating);
	$rating = str_replace('K-14', 'Alla 14 a. keelatud', $rating);
	$rating = str_replace('K-12', 'Alla 12 a. keelatud', $rating);
	$rating = str_replace('Lubatud alates 18a.', 'Alla 18 a. keelatud', $rating);
	$rating = str_replace('Lubatud alates 16a.', 'Alla 16 a. keelatud', $rating);
	$rating = str_replace('Lubatud alates 14a.', 'Alla 14 a. keelatud', $rating);
	$rating = str_replace('Lubatud alates 12a.', 'Alla 12 a. keelatud', $rating);
	$rating = str_replace('MS-18', 'Alla 18 a. mittesoovitatav', $rating);
	$rating = str_replace('MS-16', 'Alla 16 a. mittesoovitatav', $rating);
	$rating = str_replace('MS-14', 'Alla 14 a. mittesoovitatav', $rating);
	$rating = str_replace('MS-12', 'Alla 12 a. mittesoovitatav', $rating);
	$rating = str_replace('MS-6', 'Alla 6 a. mittesoovitatav', $rating);
	$rating = str_replace('Alla 12a. mittesoovitatav', 'Alla 12 a. mittesoovitatav', $rating);
	$rating = str_replace('Alla 12-aastastele mittesoovitatav!', 'Alla 12 a. mittesoovitatav', $rating);
	$rating = str_replace('Alla 6a. mittesoovitatav', 'Alla 6 a. mittesoovitatav', $rating);
	$rating = str_replace('Alla 6-aastastele mittesoovitatav!', 'Alla 6 a. mittesoovitatav', $rating);
	$rating = str_replace('PERE', 'Perefilm', $rating);
	$rating = str_replace('Kogu perele', 'Perefilm', $rating);
	if ($rating == 'L') {$rating = 'Lubatud kõigile';}
  return trim($rating);
}

function fixID($id) {
	$src = array(
	  'а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п',
	  'р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я',
	  'А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П',
	  'Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я',
		'õ','Õ','ä','Ä','ö','Ö','ü','Ü','é','í'
	);
	$dest = array(
	  'a','b','v','g','d','e','e','zh','z','i','y','k','l','m','n','o','p',
	  'r','s','t','u','f','h','ts','ch','sh','sht','a','i','','e','yu','ya',
	  'a','b','v','g','d','e','io','zh','z','i','y','k','l','m','n','o','p',
	  'r','s','t','u','f','h','ts','ch','sh','sht','a','i','y','e','yu','ya',
		'o','o','a','a','o','o','u','u','e','i'
	);
	$id = str_replace($src, $dest, $id);
  $id = str_replace("%27", "", $id);
  $id = str_replace("&amp;", "", $id);
  $id = mb_convert_case(preg_replace('/[^A-Za-z0-9]/', '', $id), MB_CASE_LOWER, 'UTF-8');
	if($id == 'starwarsepisodeviiithelastjedi') {$id = 'starwarsthelastjedi';}
  if($id == 'thejusticeleaguepartone') {$id = 'justiceleague';}
  if($id == 'igitee') {$id = 'ikitie';}
  return $id;
}
?>
