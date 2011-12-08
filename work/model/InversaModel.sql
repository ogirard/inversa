



-- -----------------------------------------------------------
-- Entity Designer DDL Script for MySQL Server 4.1 and higher
-- -----------------------------------------------------------
-- Date Created: 11/24/2011 13:49:04
-- Generated from EDMX file: C:\VS2010_WorkSpace\Private\Inversa\InversaAdmin\InversaAdmin.Model\InversaModel.edmx
-- Target version: 2.0.0.0
-- --------------------------------------------------


-- --------------------------------------------------
-- Dropping existing FOREIGN KEY constraints
-- NOTE: if the constraint does not exist, an ignorable error will be reported.
-- --------------------------------------------------

--    ALTER TABLE `inversaevent` DROP CONSTRAINT `FK_EventLocation_FK`;
--    ALTER TABLE `file` DROP CONSTRAINT `FK_InversaEventFile`;
--    ALTER TABLE `image` DROP CONSTRAINT `FK_InversaEventImage`;
--    ALTER TABLE `weburl` DROP CONSTRAINT `FK_InversaEventWebUrl`;
--    ALTER TABLE `file` DROP CONSTRAINT `FK_InversaMediaFile`;
--    ALTER TABLE `image` DROP CONSTRAINT `FK_InversaMediaImage`;
--    ALTER TABLE `file` DROP CONSTRAINT `FK_InversaPressItemFile`;
--    ALTER TABLE `image` DROP CONSTRAINT `FK_InversaPressItemImage`;
--    ALTER TABLE `file` DROP CONSTRAINT `FK_ProjectFile`;
--    ALTER TABLE `image` DROP CONSTRAINT `FK_ProjectImage`;
--    ALTER TABLE `weburl` DROP CONSTRAINT `FK_ProjectWebUrl`;
--    ALTER TABLE `location` DROP CONSTRAINT `FK_LocationImage_FK`;

-- --------------------------------------------------
-- Dropping existing tables
-- --------------------------------------------------
SET foreign_key_checks = 0;
    DROP TABLE IF EXISTS `file`;
    DROP TABLE IF EXISTS `image`;
    DROP TABLE IF EXISTS `inversaevent`;
    DROP TABLE IF EXISTS `inversamedia`;
    DROP TABLE IF EXISTS `inversapressitem`;
    DROP TABLE IF EXISTS `inversaproject`;
    DROP TABLE IF EXISTS `location`;
    DROP TABLE IF EXISTS `user`;
    DROP TABLE IF EXISTS `weburl`;
SET foreign_key_checks = 1;

-- --------------------------------------------------
-- Creating all tables
-- --------------------------------------------------

-- Creating table 'User'

CREATE TABLE `User` (
    `UserID` int AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `Name` longtext  NOT NULL,
    `FirstName` longtext  NOT NULL,
    `LoginName` longtext  NOT NULL,
    `LastLoginTimestamp` datetime  NOT NULL,
    `EMail` longtext  NULL,
    

    `IsActive` bool  NOT NULL
);

-- Creating table 'InversaProject'

CREATE TABLE `InversaProject` (
    `ProjectID` int AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `Name` longtext  NOT NULL,
    `Description` longtext  NOT NULL,
    

    `IsActive` bool  NOT NULL
);

-- Creating table 'WebUrl'

CREATE TABLE `WebUrl` (
    `UrlID` int AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `DisplayName` longtext  NOT NULL,
    `Url` longtext  NOT NULL,
    

    `IsActive` bool  NOT NULL,
    `ProjectWebUrl_WebUrl_ProjectID` int  NULL,
    `InversaEventWebUrl_WebUrl_EventID` int  NULL
);

-- Creating table 'Image'

CREATE TABLE `Image` (
    `ImageID` int AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `Name` longtext  NOT NULL,
    `Type` longtext  NOT NULL,
    `Width` smallint  NOT NULL,
    `Height` smallint  NOT NULL,
    `Path` longtext  NOT NULL,
    

    `IsActive` bool  NOT NULL,
    `ProjectImage_Image_ProjectID` int  NULL,
    `InversaEventImage_Image_EventID` int  NULL,
    `InversaMediaImage_Image_MediaID` int  NULL,
    `InversaPressItemImage_Image_PressItemID` int  NULL
);

-- Creating table 'File'

CREATE TABLE `File` (
    `FileID` int AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `Name` longtext  NOT NULL,
    `Type` longtext  NOT NULL,
    `Path` longtext  NOT NULL,
    `IsActive` bool  NOT NULL,
    `ProjectFile_File_ProjectID` int  NULL,
    `InversaEventFile_File_EventID` int  NULL,
    `InversaMediaFile_File_MediaID` int  NULL,
    `InversaPressItemFile_File_PressItemID` int  NULL
);

-- Creating table 'InversaEvent'

CREATE TABLE `InversaEvent` (
    `EventID` int AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `Name` longtext  NOT NULL,
    `Description` longtext  NOT NULL,
    `When` datetime  NOT NULL,
    `Who` longtext  NOT NULL,
    `IsActive` bool  NOT NULL,
    `LocationID` int  NULL
);

-- Creating table 'InversaMedia'

CREATE TABLE `InversaMedia` (
    `MediaID` int AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `Name` longtext  NOT NULL,
    `Description` longtext  NOT NULL,
    `IsActive` bool  NOT NULL
);

-- Creating table 'InversaPressItem'

CREATE TABLE `InversaPressItem` (
    `PressItemID` int AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `Name` longtext  NOT NULL,
    `Description` longtext  NOT NULL,
    `Published` datetime  NOT NULL,
    `IsActive` bool  NOT NULL
);

-- Creating table 'Location'

CREATE TABLE `Location` (
    `LocationID` int  NOT NULL,
    `Name` longtext  NOT NULL,
    `Description` longtext  NOT NULL,
    `Address` longtext  NOT NULL,
    `MapUrl` longtext  NOT NULL,
    `IsActive` bool  NOT NULL,
    `ImageID` int  NULL
);



-- --------------------------------------------------
-- Creating all PRIMARY KEY constraints
-- --------------------------------------------------

-- Creating primary key on `LocationID` in table 'Location'

ALTER TABLE `Location`
ADD CONSTRAINT `PK_Location`
    PRIMARY KEY (`LocationID` );



-- --------------------------------------------------
-- Creating all FOREIGN KEY constraints
-- --------------------------------------------------

-- Creating foreign key on `ProjectWebUrl_WebUrl_ProjectID` in table 'WebUrl'

ALTER TABLE `WebUrl`
ADD CONSTRAINT `FK_ProjectWebUrl`
    FOREIGN KEY (`ProjectWebUrl_WebUrl_ProjectID`)
    REFERENCES `InversaProject`
        (`ProjectID`)
    ON DELETE NO ACTION ON UPDATE NO ACTION;

-- Creating non-clustered index for FOREIGN KEY 'FK_ProjectWebUrl'

CREATE INDEX `IX_FK_ProjectWebUrl` 
    ON `WebUrl`
    (`ProjectWebUrl_WebUrl_ProjectID`);

-- Creating foreign key on `ProjectImage_Image_ProjectID` in table 'Image'

ALTER TABLE `Image`
ADD CONSTRAINT `FK_ProjectImage`
    FOREIGN KEY (`ProjectImage_Image_ProjectID`)
    REFERENCES `InversaProject`
        (`ProjectID`)
    ON DELETE NO ACTION ON UPDATE NO ACTION;

-- Creating non-clustered index for FOREIGN KEY 'FK_ProjectImage'

CREATE INDEX `IX_FK_ProjectImage` 
    ON `Image`
    (`ProjectImage_Image_ProjectID`);

-- Creating foreign key on `ProjectFile_File_ProjectID` in table 'File'

ALTER TABLE `File`
ADD CONSTRAINT `FK_ProjectFile`
    FOREIGN KEY (`ProjectFile_File_ProjectID`)
    REFERENCES `InversaProject`
        (`ProjectID`)
    ON DELETE NO ACTION ON UPDATE NO ACTION;

-- Creating non-clustered index for FOREIGN KEY 'FK_ProjectFile'

CREATE INDEX `IX_FK_ProjectFile` 
    ON `File`
    (`ProjectFile_File_ProjectID`);

-- Creating foreign key on `InversaEventImage_Image_EventID` in table 'Image'

ALTER TABLE `Image`
ADD CONSTRAINT `FK_InversaEventImage`
    FOREIGN KEY (`InversaEventImage_Image_EventID`)
    REFERENCES `InversaEvent`
        (`EventID`)
    ON DELETE NO ACTION ON UPDATE NO ACTION;

-- Creating non-clustered index for FOREIGN KEY 'FK_InversaEventImage'

CREATE INDEX `IX_FK_InversaEventImage` 
    ON `Image`
    (`InversaEventImage_Image_EventID`);

-- Creating foreign key on `InversaEventWebUrl_WebUrl_EventID` in table 'WebUrl'

ALTER TABLE `WebUrl`
ADD CONSTRAINT `FK_InversaEventWebUrl`
    FOREIGN KEY (`InversaEventWebUrl_WebUrl_EventID`)
    REFERENCES `InversaEvent`
        (`EventID`)
    ON DELETE NO ACTION ON UPDATE NO ACTION;

-- Creating non-clustered index for FOREIGN KEY 'FK_InversaEventWebUrl'

CREATE INDEX `IX_FK_InversaEventWebUrl` 
    ON `WebUrl`
    (`InversaEventWebUrl_WebUrl_EventID`);

-- Creating foreign key on `InversaEventFile_File_EventID` in table 'File'

ALTER TABLE `File`
ADD CONSTRAINT `FK_InversaEventFile`
    FOREIGN KEY (`InversaEventFile_File_EventID`)
    REFERENCES `InversaEvent`
        (`EventID`)
    ON DELETE NO ACTION ON UPDATE NO ACTION;

-- Creating non-clustered index for FOREIGN KEY 'FK_InversaEventFile'

CREATE INDEX `IX_FK_InversaEventFile` 
    ON `File`
    (`InversaEventFile_File_EventID`);

-- Creating foreign key on `InversaMediaFile_File_MediaID` in table 'File'

ALTER TABLE `File`
ADD CONSTRAINT `FK_InversaMediaFile`
    FOREIGN KEY (`InversaMediaFile_File_MediaID`)
    REFERENCES `InversaMedia`
        (`MediaID`)
    ON DELETE NO ACTION ON UPDATE NO ACTION;

-- Creating non-clustered index for FOREIGN KEY 'FK_InversaMediaFile'

CREATE INDEX `IX_FK_InversaMediaFile` 
    ON `File`
    (`InversaMediaFile_File_MediaID`);

-- Creating foreign key on `InversaMediaImage_Image_MediaID` in table 'Image'

ALTER TABLE `Image`
ADD CONSTRAINT `FK_InversaMediaImage`
    FOREIGN KEY (`InversaMediaImage_Image_MediaID`)
    REFERENCES `InversaMedia`
        (`MediaID`)
    ON DELETE NO ACTION ON UPDATE NO ACTION;

-- Creating non-clustered index for FOREIGN KEY 'FK_InversaMediaImage'

CREATE INDEX `IX_FK_InversaMediaImage` 
    ON `Image`
    (`InversaMediaImage_Image_MediaID`);

-- Creating foreign key on `InversaPressItemImage_Image_PressItemID` in table 'Image'

ALTER TABLE `Image`
ADD CONSTRAINT `FK_InversaPressItemImage`
    FOREIGN KEY (`InversaPressItemImage_Image_PressItemID`)
    REFERENCES `InversaPressItem`
        (`PressItemID`)
    ON DELETE NO ACTION ON UPDATE NO ACTION;

-- Creating non-clustered index for FOREIGN KEY 'FK_InversaPressItemImage'

CREATE INDEX `IX_FK_InversaPressItemImage` 
    ON `Image`
    (`InversaPressItemImage_Image_PressItemID`);

-- Creating foreign key on `InversaPressItemFile_File_PressItemID` in table 'File'

ALTER TABLE `File`
ADD CONSTRAINT `FK_InversaPressItemFile`
    FOREIGN KEY (`InversaPressItemFile_File_PressItemID`)
    REFERENCES `InversaPressItem`
        (`PressItemID`)
    ON DELETE NO ACTION ON UPDATE NO ACTION;

-- Creating non-clustered index for FOREIGN KEY 'FK_InversaPressItemFile'

CREATE INDEX `IX_FK_InversaPressItemFile` 
    ON `File`
    (`InversaPressItemFile_File_PressItemID`);

-- Creating foreign key on `LocationID` in table 'InversaEvent'

ALTER TABLE `InversaEvent`
ADD CONSTRAINT `FK_EventLocation_FK`
    FOREIGN KEY (`LocationID`)
    REFERENCES `Location`
        (`LocationID`)
    ON DELETE NO ACTION ON UPDATE NO ACTION;

-- Creating non-clustered index for FOREIGN KEY 'FK_EventLocation_FK'

CREATE INDEX `IX_FK_EventLocation_FK` 
    ON `InversaEvent`
    (`LocationID`);

-- Creating foreign key on `ImageID` in table 'Location'

ALTER TABLE `Location`
ADD CONSTRAINT `FK_LocationImage_FK`
    FOREIGN KEY (`ImageID`)
    REFERENCES `Image`
        (`ImageID`)
    ON DELETE NO ACTION ON UPDATE NO ACTION;

-- Creating non-clustered index for FOREIGN KEY 'FK_LocationImage_FK'

CREATE INDEX `IX_FK_LocationImage_FK` 
    ON `Location`
    (`ImageID`);

-- --------------------------------------------------
-- Script has ended
-- --------------------------------------------------