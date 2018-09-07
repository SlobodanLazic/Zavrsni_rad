INSERT INTO zavrsni_rad.KORISNIK_ROLA
VALUES 
	('1','Administrator', 'Administrator ima prava da dodaje albume i pregleda albume odnosno da menja sadrzaj web aplikacije'),
	('2','Korisnik', 'Korisnik ima prava da pregleda albume i da kupi albume');
    
INSERT INTO zavrsni_rad.KORISNIK_STATUS
VALUES 
	('1','Aktivan','Korisnik je kreiran i aktivan'),
	('2','Blokiran','Korisnik je blokiran');

INSERT INTO zavrsni_rad.TIP_ALBUMA
VALUES 
	('1','Full-album','An Album usually consists of 10-12 songs focusing on one style and usually a theme that the artist decides before hand. To call it an album most people say that it has to be over 25 minutes long.'),
	('2','EP','An EP is an extended play, which is more contains more songs than a single, but less songs than an full-album.EP is defined as a four or more track release with the tracks being of equal importance to one another'),
	('3','Demo','Demos are usually what bands or singer songwriters create themselves using whatever tools they have available.Demos are usually 3-4 songs and consist of a mix of covers and originals.'),
    ('4','Single','Singles usually refer to one song that an artist is releasing. It is usually a part of the album and is released before the album is to gain exposure and a extend the fan base. '),
    ('5','Split','A split album (or split) is a music album which includes tracks by two or more separate artists.Split albums differ from "various artists" compilation albums in that they generally include several tracks of each artist'),
    ('6','Compilation','A compilation album comprises tracks, either previously released or unreleased, usually from several separate recordings by either one or several performers or multiple artists with only one or two tracks each.');