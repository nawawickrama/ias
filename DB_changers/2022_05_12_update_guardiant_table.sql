alter table guardians
    add isComplete enum ('Yes', 'No') default 'No' not null after candidate_id;
