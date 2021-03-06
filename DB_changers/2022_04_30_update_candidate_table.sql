alter table candidates
    add user_id int null after passport_no;

create unique index candidates_email_uindex
    on candidates (email);

create unique index candidates_telephone_uindex
    on candidates (telephone);

alter table candidates
    add isComplete enum ('Yes', 'No') default 'No' not null after user_id;

