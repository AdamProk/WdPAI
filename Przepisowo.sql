/*
 Navicat Premium Data Transfer

 Source Server         : wdpai
 Source Server Type    : PostgreSQL
 Source Server Version : 160001 (160001)
 Source Host           : localhost:5433
 Source Catalog        : przepisowo
 Source Schema         : public

 Target Server Type    : PostgreSQL
 Target Server Version : 160001 (160001)
 File Encoding         : 65001

 Date: 07/02/2024 13:16:30
*/


-- ----------------------------
-- Sequence structure for Comments_ID_comments_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."Comments_ID_comments_seq";
CREATE SEQUENCE "public"."Comments_ID_comments_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for Comments_ID_recipe_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."Comments_ID_recipe_seq";
CREATE SEQUENCE "public"."Comments_ID_recipe_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for Comments_ID_user_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."Comments_ID_user_seq";
CREATE SEQUENCE "public"."Comments_ID_user_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for Cuisine_ID_cuisine_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."Cuisine_ID_cuisine_seq";
CREATE SEQUENCE "public"."Cuisine_ID_cuisine_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for Recipe_cuisine_ID_cuisine_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."Recipe_cuisine_ID_cuisine_seq";
CREATE SEQUENCE "public"."Recipe_cuisine_ID_cuisine_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for Recipe_cuisine_ID_recipe_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."Recipe_cuisine_ID_recipe_seq";
CREATE SEQUENCE "public"."Recipe_cuisine_ID_recipe_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for Recipes_ID_recipe_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."Recipes_ID_recipe_seq";
CREATE SEQUENCE "public"."Recipes_ID_recipe_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for Recipes_ID_user_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."Recipes_ID_user_seq";
CREATE SEQUENCE "public"."Recipes_ID_user_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for Roles_ID_role_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."Roles_ID_role_seq";
CREATE SEQUENCE "public"."Roles_ID_role_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for User_role_ID_role_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."User_role_ID_role_seq";
CREATE SEQUENCE "public"."User_role_ID_role_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for User_role_ID_user_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."User_role_ID_user_seq";
CREATE SEQUENCE "public"."User_role_ID_user_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for Users_ID_user_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."Users_ID_user_seq";
CREATE SEQUENCE "public"."Users_ID_user_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Table structure for Comments
-- ----------------------------
DROP TABLE IF EXISTS "public"."Comments";
CREATE TABLE "public"."Comments" (
  "ID_comments" int8 NOT NULL DEFAULT nextval('"Comments_ID_comments_seq"'::regclass),
  "ID_user" int8 NOT NULL DEFAULT nextval('"Comments_ID_user_seq"'::regclass),
  "ID_recipe" int8 NOT NULL DEFAULT nextval('"Comments_ID_recipe_seq"'::regclass),
  "comment" varchar(255) COLLATE "pg_catalog"."default",
  "comment_date" date
)
;

-- ----------------------------
-- Records of Comments
-- ----------------------------
INSERT INTO "public"."Comments" VALUES (23, 1, 2, 'fajny komentarz
', '2024-02-05');
INSERT INTO "public"."Comments" VALUES (24, 107, 5, 'fajny ten przepis', '2024-02-07');
INSERT INTO "public"."Comments" VALUES (25, 108, 6, 'kom,entarz', '2024-02-07');

-- ----------------------------
-- Table structure for Cuisine
-- ----------------------------
DROP TABLE IF EXISTS "public"."Cuisine";
CREATE TABLE "public"."Cuisine" (
  "ID_cuisine" int8 NOT NULL DEFAULT nextval('"Cuisine_ID_cuisine_seq"'::regclass),
  "cuisine" varchar(255) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of Cuisine
-- ----------------------------
INSERT INTO "public"."Cuisine" VALUES (1, 'kuchnia włoska');
INSERT INTO "public"."Cuisine" VALUES (2, 'kuchnia japońska');
INSERT INTO "public"."Cuisine" VALUES (3, 'fast food');
INSERT INTO "public"."Cuisine" VALUES (4, 'kuchnia polska');

-- ----------------------------
-- Table structure for Recipe_cuisine
-- ----------------------------
DROP TABLE IF EXISTS "public"."Recipe_cuisine";
CREATE TABLE "public"."Recipe_cuisine" (
  "ID_recipe" int8 NOT NULL DEFAULT nextval('"Recipe_cuisine_ID_recipe_seq"'::regclass),
  "ID_cuisine" int8 NOT NULL DEFAULT nextval('"Recipe_cuisine_ID_cuisine_seq"'::regclass)
)
;

-- ----------------------------
-- Records of Recipe_cuisine
-- ----------------------------
INSERT INTO "public"."Recipe_cuisine" VALUES (1, 4);
INSERT INTO "public"."Recipe_cuisine" VALUES (2, 1);

-- ----------------------------
-- Table structure for Recipes
-- ----------------------------
DROP TABLE IF EXISTS "public"."Recipes";
CREATE TABLE "public"."Recipes" (
  "ID_recipe" int8 NOT NULL DEFAULT nextval('"Recipes_ID_recipe_seq"'::regclass),
  "ID_user" int8 NOT NULL DEFAULT nextval('"Recipes_ID_user_seq"'::regclass),
  "likes" varchar(255) COLLATE "pg_catalog"."default",
  "dislikes" varchar(255) COLLATE "pg_catalog"."default",
  "recipe_picture" varchar COLLATE "pg_catalog"."default",
  "recipe_date" date,
  "comments_amount" int2,
  "recipe_name" varchar(255) COLLATE "pg_catalog"."default",
  "description" varchar(9999999) COLLATE "pg_catalog"."default",
  "ingredients" varchar(9999999) COLLATE "pg_catalog"."default",
  "prep_time" int2,
  "amount" int2
)
;

-- ----------------------------
-- Records of Recipes
-- ----------------------------
INSERT INTO "public"."Recipes" VALUES (1, 1, '0', '0', 'kotlet.jpg', '2024-01-17', 0, 'Kotlet schabowy', 'Ostrym nożem odciąć białą otoczkę z żyłki po zewnętrznej części mięsa. Pokroić na 4 plastry. Położyć na desce i dokładnie roztłuc na cieniutkie filety (mogą wyjść duże, wielkości pół talerza). Do rozbicia mięsa najlepiej użyć specjalnego tłuczka z metalowym obiciem z wytłoczoną krateczką.
Filety namoczyć w mleku z dodatkiem soli i pieprzu (ewentualnie z dodatkiem kilku plastrów cebuli) przez ok. 2 godziny lub dłużej jeśli mamy czas (można też zostawić do namoczenia na noc).
Wyjąć filety z mleka i osuszyć je papierowymi ręcznikami. Doprawić solą (niezbyt dużo, bo zalewa z mleka była już solona) i pieprzem, obtoczyć w mące, następnie w roztrzepanym jajku, a na koniec w bułce tartej.
Na patelni rozgrzać klarowane masło (ok. 1/2 cm warstwa) lub smalec. Smażyć partiami po 2 kotlety, na większym ogniu, po 2 minuty z każdej strony. Następnie zmniejszyć ogień i smażyć jeszcze po ok. 3 minuty z każdej strony. Przetrzeć patelnię papierowym ręcznikiem i powtórzyć z kolejną partią, na świeżym tłuszczu.
Usmażone schabowe odsączyć z tłuszczu na papierowym ręczniku i podawać z ziemniakami i kapustą lub mizerią.', '600 g schabu bez kości
sól i pieprz
do namoczenia: mleko
do obtoczenia: 2 łyżki mąki, 2 jajka, 5 łyżek bułki tartej
do smażenia: 6 łyżek masła klarowanego lub smalcu', 40, 4);
INSERT INTO "public"."Recipes" VALUES (2, 2, '0', '0', 'spaghetti.png', '2023-09-12', 1, 'Spaghetti Bolognese', 'Z 500 gramów suchego makaronu spaghetti otrzymasz po ugotowaniu około 1100-1300 gramów makaronu. Kalorie policzone zostały na podstawie użytych przeze mnie składników. Jest to więc orientacyjna ilość kalorii liczona na podstawie produktów, których użyłam w danym przepisie. Podczas liczenia kalorii nie uwzględniłam dodatku tartego sera. Z podanej ilości składników otrzymasz około ośmiu porcji Spaghetti Bolognese.

Spaghetti bolognese to wspaniały pomysł na pyszny i jednocześnie wykwintny obiad. Przed szykowaniem spaghetti zachęcam też do przeczytania najpierw całego wpisu. W treści podaję bowiem dużo ciekawych porad dotyczących składników oraz ich zamienników. Być może zapragniesz użyć np. białego wina zamiast czerwonego lub też dodać odrobinę pancetty lub boczku. Przygotuj sobie średnią patelnię z grubym dnem. Zacznij ją nagrzewać. Dodaj dwie łyżki oleju do smażenia. Na patelnię wyłóż obraną i drobno posiekaną cebulę. Podsmażaj cebulkę na średniej mocy palnika przez około 8 minut, aż zrobi się rumiana. Po tym czasie dodaj tej dwa ząbki czosnku. Obierz je wcześniej i pokrój w plasterki. Cebulę z czosnkiem podsmażaj jeszcze dwie minuty.W trakcie podsmażania cebuli przygotuj pozostałe warzywa. Marchewki obierz i pokrój w bardzo drobną kosteczkę (użyłam trzech młodych sztuk ). Tak samo drobno pokrój również łodygi selera naciowego (2-4 w zależności od grubości). Warzywa dodaj na patelnię z cebulą i czosnkiem. Całość podsmażaj na średniej mocy palnika przez pięć minut. Po tym czasie wszystkie warzywa przełóż do garnka o pojemności nie mniejszej niż 2,5 litra, w którym będziesz szykować sos do spaghetti. Póki co nie nagrzewaj jeszcze garnka z warzywami.
', '500 g wołowiny z odrobiną wieprzowiny
200 gramów Guanciale, Pancetta lub surowego boczku - można pominąć
1 litr bulionu np. warzywnego lub wołowego - lub mniej
3/4 szklanki wytrawnego wina - czerwone lub białe
puszka pomidorów w kawałkach - 400 g
3 łyżki koncentratu pomidorowego
2 ząbki czosnku - 10 g
1 spora cebula - do 300 g
3 łodygi selera naciowego - 180 g
1-2 marchewki - 200 g
1/3 szklanki mleka
4 łyżki oleju do smażenia
przyprawy: po łyżeczce soli i oregano; płaska łyżeczka pieprzu
500 g makaronu do spaghetti - waga przed ugotowaniem
do posypania dania: tarty parmezan, listki bazylii', 64, 8);
INSERT INTO "public"."Recipes" VALUES (5, 107, '0', '0', 'kotlet.jpg', '2024-02-07', 1, 'przepis 1', 'asdasdasdasda', 'asdasdsadasdasd', 123, 123);
INSERT INTO "public"."Recipes" VALUES (6, 108, '0', '0', 'kotlet.jpg', '2024-02-07', 1, '123', '123', '123', 23, 23);

-- ----------------------------
-- Table structure for Roles
-- ----------------------------
DROP TABLE IF EXISTS "public"."Roles";
CREATE TABLE "public"."Roles" (
  "ID_role" int8 NOT NULL DEFAULT nextval('"Roles_ID_role_seq"'::regclass),
  "role" varchar(255) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of Roles
-- ----------------------------
INSERT INTO "public"."Roles" VALUES (1, 'admin');
INSERT INTO "public"."Roles" VALUES (2, 'user');

-- ----------------------------
-- Table structure for User_role
-- ----------------------------
DROP TABLE IF EXISTS "public"."User_role";
CREATE TABLE "public"."User_role" (
  "ID_user" int8 NOT NULL DEFAULT nextval('"User_role_ID_user_seq"'::regclass),
  "ID_role" int8 NOT NULL DEFAULT nextval('"User_role_ID_role_seq"'::regclass)
)
;

-- ----------------------------
-- Records of User_role
-- ----------------------------
INSERT INTO "public"."User_role" VALUES (1, 1);
INSERT INTO "public"."User_role" VALUES (2, 2);
INSERT INTO "public"."User_role" VALUES (107, 2);
INSERT INTO "public"."User_role" VALUES (108, 2);

-- ----------------------------
-- Table structure for Users
-- ----------------------------
DROP TABLE IF EXISTS "public"."Users";
CREATE TABLE "public"."Users" (
  "ID_user" int8 NOT NULL DEFAULT nextval('"Users_ID_user_seq"'::regclass),
  "email" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "password" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "name" varchar(255) COLLATE "pg_catalog"."default",
  "profile_picture" varchar(255) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of Users
-- ----------------------------
INSERT INTO "public"."Users" VALUES (1, 'admin@admin.com', '$2y$10$XyDd8hYVr.2s7O8zAjzMYeF95zgJn90vMRqpT6gWaEQjhjmgC0BFO', 'admin', 'sample.png');
INSERT INTO "public"."Users" VALUES (2, 'user@user.com', '$2y$10$UfjqpJcgvJl0yh5lWndQHOh.0aC1QnHhjPzfNG4/RI6.27nLuqdau', 'user', 'sample.png');
INSERT INTO "public"."Users" VALUES (107, 'tfujkot@xd', '$2y$10$3d//65hl5EC9aBvhZ/0O2.TR03AEMbnC7XmOXLA3vR/lvijWzjlQm', 'tfujkot', 'sample.png');
INSERT INTO "public"."Users" VALUES (108, 'asd@asd', '$2y$10$1nS5cXR8gSaAArzCwDC59OSoiSli/jLjxDm96GgCzrrMHG9lhmT6i', 'asd', 'sample.png');

-- ----------------------------
-- Function structure for update_comments_amount
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."update_comments_amount"();
CREATE OR REPLACE FUNCTION "public"."update_comments_amount"()
  RETURNS "pg_catalog"."trigger" AS $BODY$
BEGIN
    -- Count the number of comments for the given ID_recipe
    UPDATE "Recipes"
    SET comments_amount = (
        SELECT COUNT(*)
        FROM "Comments"
        WHERE "ID_recipe" = NEW."ID_recipe"
    )
    WHERE "ID_recipe" = NEW."ID_recipe";

    RETURN NEW;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;

-- ----------------------------
-- View structure for UserRoles
-- ----------------------------
DROP VIEW IF EXISTS "public"."UserRoles";
CREATE VIEW "public"."UserRoles" AS  SELECT u."ID_user",
    u.email,
    u.name,
    r.role
   FROM "Users" u
     JOIN "User_role" ur ON ur."ID_user" = u."ID_user"
     JOIN "Roles" r ON r."ID_role" = ur."ID_role";

-- ----------------------------
-- View structure for RecipeComments
-- ----------------------------
DROP VIEW IF EXISTS "public"."RecipeComments";
CREATE VIEW "public"."RecipeComments" AS  SELECT rec.recipe_name,
    u.name AS commenter,
    com.comment,
    com.comment_date,
    u.profile_picture AS commenter_pic
   FROM "Comments" com
     JOIN "Users" u ON u."ID_user" = com."ID_user"
     JOIN "Recipes" rec ON rec."ID_recipe" = com."ID_recipe";

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."Comments_ID_comments_seq"
OWNED BY "public"."Comments"."ID_comments";
SELECT setval('"public"."Comments_ID_comments_seq"', 25, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."Comments_ID_recipe_seq"
OWNED BY "public"."Comments"."ID_recipe";
SELECT setval('"public"."Comments_ID_recipe_seq"', 1, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."Comments_ID_user_seq"
OWNED BY "public"."Comments"."ID_user";
SELECT setval('"public"."Comments_ID_user_seq"', 1, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."Cuisine_ID_cuisine_seq"
OWNED BY "public"."Cuisine"."ID_cuisine";
SELECT setval('"public"."Cuisine_ID_cuisine_seq"', 1, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."Recipe_cuisine_ID_cuisine_seq"
OWNED BY "public"."Recipe_cuisine"."ID_cuisine";
SELECT setval('"public"."Recipe_cuisine_ID_cuisine_seq"', 1, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."Recipe_cuisine_ID_recipe_seq"
OWNED BY "public"."Recipe_cuisine"."ID_recipe";
SELECT setval('"public"."Recipe_cuisine_ID_recipe_seq"', 1, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."Recipes_ID_recipe_seq"
OWNED BY "public"."Recipes"."ID_recipe";
SELECT setval('"public"."Recipes_ID_recipe_seq"', 6, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."Recipes_ID_user_seq"
OWNED BY "public"."Recipes"."ID_user";
SELECT setval('"public"."Recipes_ID_user_seq"', 1, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."Roles_ID_role_seq"
OWNED BY "public"."Roles"."ID_role";
SELECT setval('"public"."Roles_ID_role_seq"', 1, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."User_role_ID_role_seq"
OWNED BY "public"."User_role"."ID_role";
SELECT setval('"public"."User_role_ID_role_seq"', 1, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."User_role_ID_user_seq"
OWNED BY "public"."User_role"."ID_user";
SELECT setval('"public"."User_role_ID_user_seq"', 1, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."Users_ID_user_seq"
OWNED BY "public"."Users"."ID_user";
SELECT setval('"public"."Users_ID_user_seq"', 108, true);

-- ----------------------------
-- Triggers structure for table Comments
-- ----------------------------
CREATE TRIGGER "update_comments_trigger" AFTER INSERT OR DELETE ON "public"."Comments"
FOR EACH ROW
EXECUTE PROCEDURE "public"."update_comments_amount"();

-- ----------------------------
-- Primary Key structure for table Comments
-- ----------------------------
ALTER TABLE "public"."Comments" ADD CONSTRAINT "Comments_pkey" PRIMARY KEY ("ID_comments");

-- ----------------------------
-- Primary Key structure for table Cuisine
-- ----------------------------
ALTER TABLE "public"."Cuisine" ADD CONSTRAINT "Cuisine_pkey" PRIMARY KEY ("ID_cuisine");

-- ----------------------------
-- Primary Key structure for table Recipe_cuisine
-- ----------------------------
ALTER TABLE "public"."Recipe_cuisine" ADD CONSTRAINT "Recipe_cuisine_pkey" PRIMARY KEY ("ID_recipe", "ID_cuisine");

-- ----------------------------
-- Primary Key structure for table Recipes
-- ----------------------------
ALTER TABLE "public"."Recipes" ADD CONSTRAINT "Recipes_pkey" PRIMARY KEY ("ID_recipe");

-- ----------------------------
-- Primary Key structure for table Roles
-- ----------------------------
ALTER TABLE "public"."Roles" ADD CONSTRAINT "Roles_pkey" PRIMARY KEY ("ID_role");

-- ----------------------------
-- Primary Key structure for table User_role
-- ----------------------------
ALTER TABLE "public"."User_role" ADD CONSTRAINT "User_role_pkey" PRIMARY KEY ("ID_user", "ID_role");

-- ----------------------------
-- Uniques structure for table Users
-- ----------------------------
ALTER TABLE "public"."Users" ADD CONSTRAINT "ID_user" UNIQUE ("ID_user");
ALTER TABLE "public"."Users" ADD CONSTRAINT "email" UNIQUE ("email");
ALTER TABLE "public"."Users" ADD CONSTRAINT "username" UNIQUE ("name");

-- ----------------------------
-- Primary Key structure for table Users
-- ----------------------------
ALTER TABLE "public"."Users" ADD CONSTRAINT "Users_pkey" PRIMARY KEY ("ID_user");

-- ----------------------------
-- Foreign Keys structure for table Comments
-- ----------------------------
ALTER TABLE "public"."Comments" ADD CONSTRAINT "ID_recipe" FOREIGN KEY ("ID_recipe") REFERENCES "public"."Recipes" ("ID_recipe") ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE "public"."Comments" ADD CONSTRAINT "ID_user" FOREIGN KEY ("ID_user") REFERENCES "public"."Users" ("ID_user") ON DELETE CASCADE ON UPDATE CASCADE;

-- ----------------------------
-- Foreign Keys structure for table Recipe_cuisine
-- ----------------------------
ALTER TABLE "public"."Recipe_cuisine" ADD CONSTRAINT "ID_cuisine" FOREIGN KEY ("ID_cuisine") REFERENCES "public"."Cuisine" ("ID_cuisine") ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE "public"."Recipe_cuisine" ADD CONSTRAINT "ID_recpie" FOREIGN KEY ("ID_recipe") REFERENCES "public"."Recipes" ("ID_recipe") ON DELETE CASCADE ON UPDATE CASCADE;

-- ----------------------------
-- Foreign Keys structure for table Recipes
-- ----------------------------
ALTER TABLE "public"."Recipes" ADD CONSTRAINT "ID_user" FOREIGN KEY ("ID_user") REFERENCES "public"."Users" ("ID_user") ON DELETE CASCADE ON UPDATE CASCADE;

-- ----------------------------
-- Foreign Keys structure for table User_role
-- ----------------------------
ALTER TABLE "public"."User_role" ADD CONSTRAINT "ID_role" FOREIGN KEY ("ID_role") REFERENCES "public"."Roles" ("ID_role") ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE "public"."User_role" ADD CONSTRAINT "ID_user" FOREIGN KEY ("ID_user") REFERENCES "public"."Users" ("ID_user") ON DELETE CASCADE ON UPDATE CASCADE;
